<?php


use PHPUnit\Framework\TestCase;

class ModelValidator extends TestCase
{

    public static function validateModel($model)
    {
        self::assertAllDataAreAttributes($model);
    }

    protected static function assertAllDataAreAttributes($model)
    {
        $arrayKeys = array_keys((array)$model);
        foreach ($arrayKeys as $key) {
            self::assertStringContainsString(
                '*',
                $key,
                'Data with key "' . $key . '" is not stored as model attribute.');
        }
    }
}