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
     * @param mixed $value value for property
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

            if (!is_null($castedValue)) {
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
     * Types can be "bool", "integer", "int", "float", "string", "array", "Models\Actor"
     *
     *
     * @param \ReflectionProperty $reflectionProperty
     * @param string $propertyType
     * @param $value
     * @param $valueType
     */
    private function castValueToPropertyType(\ReflectionProperty $reflectionProperty, string $propertyType, $value, $valueType)
    {
        $typeTranslator = [
            // translate to new value
            "integer" => "int",
            "boolean" => "bool",
            "double" => "float"
        ];

        if (array_key_exists($valueType, $typeTranslator)) {
            $valueType = $typeTranslator[$valueType];
        }
        if (array_key_exists($propertyType, $typeTranslator)) {
            $propertyType = $typeTranslator[$propertyType];
        }

        if ($valueType == $propertyType) {      // type matches
            return $value;
        }

        switch ($propertyType) {
            case "bool":
                return $this->castToBool($valueType, $value);
            case "int":
                return $this->castToInt($valueType, $value);
            case "float":
                return $this->castToFloat($valueType, $value);
            case "string":
                return $this->castToString($valueType, $value);
            default:
                return null;
        }
    }

    private function castToBool(string $valueType, $value): ?bool
    {
        if ($valueType == "string") {
            switch (strtolower($value)) {
                case "true":
                    return true;
                case "false":
                    return false;
            }
        }
        if ($valueType == "int") {
            switch (intval($value)) {
                case 1:
                    return true;
                case 0:
                    return false;
            }
        }
        return null;
    }

    private function castToInt(string $valueType, $value): ?int
    {
        if ($valueType == "string") {
            $castedInteger = intval($value);
            $backCastedInteger = strval($castedInteger);
            if ($backCastedInteger == $value) {
                return $castedInteger;
            } else {
                return null;
            }
        }

        if ($valueType == "bool" || $valueType == "float") {
            return intval($value);
        }

        return null;
    }

    private function castToFloat(string $valueType, $value): ?float
    {
        if ($valueType == "int") {
            return floatval($value);
        }
        if ($valueType == "string" && is_numeric($value)) {
            return floatval($value);
        }
        return null;
    }

    private function castToString(string $valueType, $value): ?string
    {
        if ($valueType == "bool") {
            return $value ? "true" : "false";
        } else if ($valueType == "int" || $valueType == "float") {
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