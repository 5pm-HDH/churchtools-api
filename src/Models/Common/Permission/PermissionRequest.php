<?php

namespace CTApi\Models\Common\Permission;

class PermissionRequest
{
    public static function forGroup(int $groupId): PermissionGroupRequestBuilder
    {
        return new PermissionGroupRequestBuilder($groupId);
    }

    public static function forPerson(int $personId): PermissionPersonRequestBuilder
    {
        return new PermissionPersonRequestBuilder($personId);
    }

    public static function myPermissions(): PermissionGlobalRequestBuilder
    {
        return new PermissionGlobalRequestBuilder();
    }
}
