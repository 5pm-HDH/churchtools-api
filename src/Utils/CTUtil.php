<?php


namespace CTApi\Utils;


class CTUtil
{
    /**
     * @param array $data
     * @return bool
     *
     * Check if given in data-array is data-container (associative array).
     * The method returns true if 'keys' are not normal numeric values like a list. This method can be used to determine
     * if a array is mend to be a data-container or a list of data-containers.
     *
     * Examples:
     * ['a', 'b', 'c'] //false
     * ["0" => 'a', "1" => 'b', "2" => 'c'] // false
     * ["a" => 'a', "b" => 'b', "c" => 'c'] // true
     */
    public static function arrayIsDataContainer(array $data): bool
    {
        if (array() === $data) return false;
        return array_keys($data) !== range(0, count($data) - 1);
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function arrayIsListContainer(array $data): bool
    {
        return !CTUtil::arrayIsDataContainer($data);
    }

}