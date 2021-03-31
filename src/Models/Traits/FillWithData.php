<?php


namespace CTApi\Models\Traits;

trait FillWithData
{
    public function fillWithData(array $array): void
    {
        foreach ($array as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $this->parseArray($key, (array)$value);
            } else {
                $this->{$key} = $value;
            }
        }
    }

    protected abstract function parseArray(string $key, array $data);
}