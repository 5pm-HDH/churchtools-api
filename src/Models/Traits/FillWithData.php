<?php

namespace CTApi\Models\Traits;

use CTApi\Utils\CTUtil;

trait FillWithData
{
    private function fillWithData(array $array): void
    {
        foreach ($array as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $this->fillArrayType($key, (array)$value);
            } else {
                $this->fillNonArrayType($key, $value);
            }
        }
    }

    protected function fillNonArrayType(string $key, $value): void
    {
        $this->{$key} = $value;
    }

    protected function fillArrayType(string $key, array $data): void
    {
        $this->{$key} = $data;
    }

    /**
     * @param array $dataArray
     * @return array
     *
     * Creates a list of models from data-array. If only a single data-container is given in, it will return an array
     * with a single model.
     */
    public static function createModelsFromArray(array $dataArray): array
    {
        if (CTUtil::arrayIsDataContainer($dataArray)) {
            $dataArray = [$dataArray];
        }

        return array_map(function ($tuple) {
            return self::createModelFromData($tuple);
        }, $dataArray);
    }

    /**
     * @param array $data
     * @return static
     *
     * Create single model from data-array. If a list of data-container is given in, it will take the first
     * data-container.
     */
    public static function createModelFromData(array $data): self
    {
        if (CTUtil::arrayIsListContainer($data)) {
            $data = $data[0];
        }

        $clazz = self::class;
        $model = new $clazz();
        $model->fillWithData($data);
        return $model;
    }
}