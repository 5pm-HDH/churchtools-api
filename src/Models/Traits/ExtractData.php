<?php

namespace CTApi\Models\Traits;

trait ExtractData
{
    /**
     * Extracts all properties and their values from the object.
     */
    public function extractData(): array
    {
        return get_object_vars($this);
    }
}
