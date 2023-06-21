# Permission API

## Internal Group Permission

```php
        use CTApi\Models\Common\Permission\PermissionRequest;

        $internalGroupPermission = PermissionRequest::forGroup(21)->get();

        var_dump( $internalGroupPermission->getSeeGroupTags());
        // Output: true

        var_dump( $internalGroupPermission->getAddPerson());
        // Output: true

        var_dump( $internalGroupPermission->getMailGroupMembers());
        // Output: true

        // ... see InternalGroupPermission-Model

```

## Internal Person Permission

```php
        use CTApi\Models\Common\Permission\PermissionRequest;

        $internalPersonPermission = PermissionRequest::forPerson(23)->get();

        var_dump( $internalPersonPermission->getSeePersons());
        // Output: 2

        var_dump( $internalPersonPermission->getInvitePerson());
        // Output: true

        var_dump( $internalPersonPermission->getSeeTags());
        // Output: true

        var_dump( $internalPersonPermission->getEditPersons());
        // Output: true

        var_dump( $internalPersonPermission->getDoFollowup());
        // Output: true


```

## Global Permission (for logged in user)

```php
        use CTApi\Models\Common\Permission\PermissionRequest;

        $globalPermission = PermissionRequest::myPermissions()->get();

        var_dump( $globalPermission->getChurchcore()?->getAdministerSettings());
        // Output: true

        var_dump( $globalPermission->getChurchdb()?->getViewBirthdaylist());
        // Output: false

        var_dump( $globalPermission->getChurchcal()?->getView());
        // Output: true

        var_dump( $globalPermission->getChurchresource()?->getCreateVirtualBookings());
        // Output: false

        var_dump( $globalPermission->getChurchservice()?->getEditTemplate());
        // Output: true

        var_dump( $globalPermission->getChurchwiki()->getEditMasterdata());
        // Output: true

        var_dump( $globalPermission->getChurchcheckin()?->getEditMasterdata());
        // Output: false


```
