<?php


namespace CTApi\Exceptions;

use CTApi\CTLog;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;

/**
 * Class CTRequestException is thrown when communication with ChurchTools api fails.
 * @package CTApi\Exceptions
 */
class CTRequestException extends RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        CTLog::getLog()->warning("CTRequestException: " . $message);
    }

    public static function ofModelNotFound(?string $modelName = null, ?Throwable $throwable = null): self
    {
        if (is_null($modelName)) {
            return new CTRequestException("Could not retrieve Model", 0, $throwable);
        } else {
            return new CTRequestException("Could not retrieve Model: " . $modelName, 0, $throwable);
        }
    }

    public static function ofErrorResponse(ResponseInterface $response): self
    {
        $contents = \json_decode((string)$response->getBody(), true);

        if (!isset($contents['message'])) {
            return new self($response->getReasonPhrase() ?: 'Unknown API error.');
        }

        $msg = $contents['message'];

        if (empty($contents['errors'])) {
            return new self($msg);
        }

        $errorDescriptions = [];

        foreach ($contents['errors'] as $error) {
            if (!is_array($error) || !isset($error['message'])) {
                continue;
            }

            if (!isset($error['messageKey'])) {
                $errorDescriptions[] = $error['message'];
                continue;
            }

            $messageKey = $error['messageKey'];

            if (!isset($error['fieldId'])) {
                $errorDescriptions[] = sprintf('%s: %s', $messageKey, $error['message']);

                continue;
            }

            if ('validation.not.empty' === $messageKey) {
                $errorDescriptions[] = sprintf('Field "%s" must not be empty.', $error['fieldId']);

                continue;
            }

            if ('validation.db.field.option' === $messageKey) {
                $errorDescriptions[] = sprintf(
                    'Field "%s" has to be one of the options "%s".',
                    $error['fieldId'],
                    $error['args']['validOptions'] ?? ''
                );

                continue;
            }

            if ('validation.string' === $messageKey) {
                $description = sprintf('Field "%s" has to be of type string. ', $error['fieldId']);

                if (array_key_exists('args', $error) && array_key_exists('value', $error['args'])) {
                    $value = $error['args']['value'];
                    $description .= sprintf('Provided value was of type "%s".', gettype($value));
                } else {
                    $description .= 'Provided value is unknown.';
                }

                $errorDescriptions[] = $description;

                continue;
            }

            if ('please.enter.valid.email' === $messageKey) {
                $description = sprintf('Field "%s" has to be a valid e-mail of type string.', $error['fieldId']);

                if (array_key_exists('args', $error) && array_key_exists('value', $error['args'])) {
                    $value = $error['args']['value'];

                    if (null === $value) {
                        $description .= ' Provided value was NULL.';
                    } else {
                        $description .= sprintf(' Provided value was "%s".', $value);
                    }
                }

                $errorDescriptions[] = $description;

                continue;
            }

            if (isset($error['message'])) {
                $args = isset($error['args']) && is_array($error['args']) ? $error['args'] : [];

                $placeholders = array_map(function ($key) {
                    return sprintf('{%s}', $key);
                }, array_keys($args));

                $description = strtr($error['message'], array_combine($placeholders, $args));
                $errorDescriptions[] = $description;

                continue;
            }
        }

        $msg .= '. ' . implode(' ', $errorDescriptions);

        return new self($msg);
    }
}