<?php


namespace CTApi\Exceptions;

use CTApi\CTLog;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;

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
        $contents = \json_decode((string) $response->getBody(), true);

        if (!isset($contents['message'])) {
            return new self($response->getReasonPhrase() ?: 'Unknown API error.');
        }

        $msg = $contents['message'];

        if (!empty($contents['errors'])) {
            $errorDescriptions = [];

            foreach ($contents['errors'] as $error) {
                $wasValue = null;

                if (array_key_exists('value', $error['args'])) {
                    $wasValue = ' Received value was %s.';

                    if (is_null($error['args']['value'])) {
                        $wasValue = sprintf($wasValue, 'null');
                    } else {
                        $wasValue = sprintf($wasValue, '"' . $error['args']['value'] . '"');
                    }
                }

                $errorDescriptions[] = sprintf(
                    'Field "%s": %s %s',
                    $error['fieldId'],
                    $error['message'],
                    $wasValue
                );
            }

            $msg .= '. ' . implode(' ', $errorDescriptions);
        }

        return new self($msg);
    }
}