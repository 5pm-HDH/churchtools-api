<?php


namespace CTApi\Utils;


use Psr\Http\Message\StreamInterface;

class CTMessageBody implements StreamInterface
{
    private array $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function __toString(): string
    {
        return json_encode($this->content);
    }

    public function close(): void
    {
        // TODO: Implement close() method.
    }

    public function detach()
    {
        return null;
    }

    public function getSize(): ?int
    {
        return null;
    }

    public function tell(): int
    {
        return 0;
    }

    public function eof(): bool
    {
        return false;
    }

    public function isSeekable(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    public function seek($offset, $whence = SEEK_SET): void
    {
        // TODO: Implement seek() method.
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        // TODO: Implement rewind() method.
    }

    public function isWritable(): bool
    {
        return true;
    }

    public function write($string): int
    {
        return 0;
    }

    public function isReadable(): bool
    {
        return true;
    }

    public function read($length): string
    {
        return implode(',', $this->content);
    }

    public function getContents(): string
    {
        return implode(',', $this->content);
    }

    public function getMetadata($key = null)
    {
        // TODO: Implement getMetadata() method.
    }
}