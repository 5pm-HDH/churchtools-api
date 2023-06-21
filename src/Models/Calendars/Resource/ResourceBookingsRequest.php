<?php


namespace CTApi\Models\Calendars\Resource;


class ResourceBookingsRequest
{
    public static function forResources(array $resources): ResourceBookingsRequestBuilder
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