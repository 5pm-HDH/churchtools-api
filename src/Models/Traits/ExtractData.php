<?php

namespace CTApi\Models\Traits;

trait ExtractData
{
    public function extractData(): array
    {
        return get_object_vars($this);
    }

    public abstract function getModifiableAttributes(): array;
}
