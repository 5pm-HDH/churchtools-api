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

    public function __toString()
    {
        return json_encode($this->content);
    }

    public function close()
    {
        // TODO: Implement close() method.
    }

    public function detach()
    {
        // TODO: Implement detach() method.
    }

    public function getSize()
    {
        return null;
    }

    public function tell()
    {
        return 0;
    }

    public function eof()
    {
        return false;
    }

    public function isSeekable()
    {
        return true;
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        // TODO: Implement seek() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    public function isWritable()
    {
        return true;
    }

    public function write($string)
    {
        return 0;
    }

    public function isReadable()
    {
        return true;
    }

    public function read($length)
    {
        return implode(',', $this->content);
    }

    public function getContents()
    {
        return implode(',', $this->content);
    }

    public function getMetadata($key = null)
    {
        // TODO: Implement getMetadata() method.
    }
}