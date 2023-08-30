<?php

namespace CTApi\Traits\Model;

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
