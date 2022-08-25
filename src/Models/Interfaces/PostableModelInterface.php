<?php

namespace CTApi\Models\Interfaces;

/**
 * This interface has to be implemented by all models to be used for
 * create or update methods.
 */
interface PostableModelInterface
{
    /**
     * Extracts all properties and their values from the object and returns them
     * as an associative array.
     *
     * @see \CTApi\Models\Traits\ExtractData::extractData()
     *      for a ready to use implementation.
     */
    function extractData(): array;

    /**
     * Get all attribute names from the model, which are modifiable in the
     * ChurchTool API.
     */
    static function getModifiableAttributes(): array;
}
