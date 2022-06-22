<?php


namespace CTApi\Requests;


use CTApi\Models\Resource;

class ResourceBookingsRequest
{
    public static function forRessources(array $resources): ResourceBookingsRequestBuilder
    {
        $idArray = [];

        foreach ($resources as $key => $value) {
            if ($value instanceof Resource && !is_null($value->getId())) {
                $idArray[] = $value->getId();
            } else {
                $idArray[] = $value;
            }
        }

        return new ResourceBookingsRequestBuilder($idArray);
    }
}