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
        if (array() === $data) {
            return false;
        } else {
            return array_keys($data) !== range(0, count($data) - 1);
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function arrayIsListContainer(array $data): bool
    {
        return (!CTUtil::arrayIsDataContainer($data) && !empty($data));
    }

    /**
     * @param array $array
     * @param string $path
     * @param $value
     * Sets the value in a array path.
     */
    public static function arrayPathSet(array &$array, string $path, $value): void
    {
        $pathArray = explode('.', $path);
        if (sizeof($pathArray) > 1) {
            $key = $pathArray[0];
            array_shift($pathArray);

            if (!array_key_exists($key, $array) || is_null($array[$key])) {
                $array[$key] = [];
            }

            self::arrayPathSet($array[$key], implode('.', $pathArray), $value);
        } else {
            $key = $pathArray[0];

            if (!array_key_exists($key, $array)) {
                $array[$key] = $value;
            } else if (is_array($array[$key])) {
                if (is_array($value)) {
                    $array[$key] = array_merge(
                        $array[$key],
                        $value
                    );
                } else {
                    array_push($array[$key], $value);
                }
            } else {
                $array[$key] = $value;
            }
        }
    }

    /**
     * @param array $array
     * @param string $path
     *
     * Gets the value in a array path.
     */
    public static function arrayPathGet(array &$array, string $path)
    {
        $pathArray = explode('.', $path);
        $key = $pathArray[0];

        if (!array_key_exists($key, $array)) {
            return null;
        }

        if (sizeof($pathArray) > 1) {
            array_shift($pathArray);

            if (!is_array($array[$key])) {
                return $array[$key];
            }

            return self::arrayPathGet($array[$key], implode('.', $pathArray));
        } else {
            return $array[$key];
        }
    }
}