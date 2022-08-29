<?php

namespace CTApi\Models\Traits;

use CTApi\CTLog;
use CTApi\Utils\CTUtil;

trait FillWithData
{
    private function fillWithData(array $array): void
    {
        foreach ($array as $key => $value) {
            if (is_object($value)) {
                $this->fillObjectType($key, $value);
            } else if (is_array($value)) {
                $this->fillArrayType($key, $value);
            } else {
                $this->fillNonArrayType($key, $value);
            }
        }
    }

    protected function fillNonArrayType(string $key, $value): void
    {
        $this->fillDefault($key, $value);
    }

    protected function fillArrayType(string $key, array $data): void
    {
        $this->fillDefault($key, $data);
    }

    protected function fillObjectType(string $key, $object): void
    {
        $this->fillDefault($key, $object);
    }

    /**
     * Fill the property of $key with the $value. Try to cast between types if possible.
     *
     * @param string $key property-name
     * @param any $value value for property
     */
    protected function fillDefault(string $key, $value): void
    {
        $reflectedClass = new \ReflectionClass(self::class);

        if ($reflectedClass->hasProperty($key)) {
            $reflectedProperty = $reflectedClass->getProperty($key);

            $valueType = gettype($value); // gettype liefert für
            if ($valueType == "object") {
                $valueType = get_class($value);
            }
            $propertyType = $reflectedProperty->getType()?->__toString() ?? "";
            $propertyType = str_replace("?", "", $propertyType); // remove "?" from optinal properties

            $castedValue = $this->castValueToPropertyType($reflectedProperty, $propertyType, $value, $valueType);

            if ($castedValue != null) {
                $reflectedProperty->setAccessible(true);
                $reflectedProperty->setValue($this, $castedValue);
            } else {
                if ($reflectedProperty->getType()?->allowsNull() ?? false) {
                    $reflectedProperty->setAccessible(true);
                    $reflectedProperty->setValue($this, null);
                } else {
                    CTLog::getLog()->warning("FillWithData: Property " . $key . " in class " . get_class($this) . " is not nullable and can't be assigned with null.");
                }
            }
        } else {
            CTLog::getLog()->warning("FillWithData: Tried to fill undefined Property " . $key . " in class " . get_class($this) . " with data. Ignore this assignment.");
        }
    }

    /**
     * Case given value to type of property.
     * Types can be "integer", "int", "string", "array", "Models\Actor"
     *
     *
     * @param \ReflectionProperty $reflectionProperty
     * @param string $propertyType
     * @param $value
     * @param $valueType
     */
    private function castValueToPropertyType(\ReflectionProperty $reflectionProperty, string $propertyType, $value, $valueType)
    {
        $propertyType = $propertyType == "integer" ? "int" : $propertyType; // convert "integer" to "int"
        $valueType = $valueType == "integer" ? "int" : $valueType;

        if ($valueType == $propertyType) {      // type matches
            return $value;
        } else if ($propertyType == "int" && $valueType == "string") {    // try to cast integer
            $castedInteger = intval($value);
            $backCastedInteger = strval($castedInteger);
            if ($backCastedInteger == $value) {
                return $castedInteger;
            } else {
                return null;
            }
        } else if ($propertyType == "string" && $valueType == "int") {    // cast string
            return strval($value);
        }

        return null;
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
     * @return self
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