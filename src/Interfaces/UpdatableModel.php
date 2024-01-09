<?php

namespace CTApi\Interfaces;

/**
 * This interface has to be implemented by all models to be used for
 * create or update methods.
 */
interface UpdatableModel
{
    /**
     * Extracts all properties and their values from the object and returns them
     * as an associative array.
     *
     * @see \CTApi\Traits\Model\ExtractData::extractData()
     *      for a ready to use implementation.
     */
    public function extractData(): array;

    /**
     * Get all attribute names from the model, which are modifiable in the
     * ChurchTool API.
     */
    public static function getModifiableAttributes(): array;
}
