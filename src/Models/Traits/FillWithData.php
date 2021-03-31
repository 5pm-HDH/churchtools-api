<?php

namespace CTApi\Models\Traits;

trait FillWithData
{
    private function fillWithData(array $array): void
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

    public static function createModelsFromArray(array $dataArray): array
    {
        return array_map(function ($tuple) {
            return self::createModelFromData($tuple);
        }, $dataArray);
    }

    public static function createModelFromData(array $data): self
    {
        $clazz = self::class;
        $model = new $clazz();
        $model->fillWithData($data);
        return $model;
    }
}