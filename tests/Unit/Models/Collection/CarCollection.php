<?php

namespace CTApi\Test\Unit\Models\Collection;

use CTApi\Models\AbstractCollection;

class CarCollection extends AbstractCollection
{
    protected function getClassType(): string
    {
        return Car::class;
    }

    protected function createInstance(array $data): CarCollection
    {
        return new CarCollection($data);
    }
}