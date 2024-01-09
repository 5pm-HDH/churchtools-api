<?php

namespace CTApi\Test\Unit\Models\Collection;

class Car
{
    public function __construct(
        public string $brand
    )
    {
    }

    public static function fromBrand(string $brand): Car
    {
        return new Car($brand);
    }
}