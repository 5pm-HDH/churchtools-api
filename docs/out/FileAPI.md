# FileAPI

## Edit Person Avatar

### Get Avatar
```php
        use CTApi\CTClient;
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;
        use CTApi\Utils\CTResponseUtil;

        $files = FileRequest::forAvatar(21)->get();
        $avatar = end($files);

        var_dump( $avatar->getId());
        // Output: 23

        var_dump( $avatar->getDomainType());
        // Output: "avatar"

        var_dump( $avatar->getDomainId());
        // Output: "41"

        var_dump( $avatar->getName());
        // Output: "avatar-1.png"

        var_dump( $avatar->getFilename());
        // Output: "eb0ee12cde07910144e3059177c42b9b46884e77368510e8178bd486b3a0748c"

        var_dump( $avatar->getFileUrl());
        // Output: "https://intern.church.tools/?q=public/filedownload&id=11076&filename=eb0ee12cde07910144e3059177c42b9b46884e77368510e8178bd486b3a0748c"

        var_dump( $avatar->getImageUrl());
        // Output: "https://intern.church.tools/images/11076/fc95ccae02311467801819503fae71db26a4dc18e19e4eca916d30831db161c2"

        var_dump( $avatar->getRelativeUrl());
        // Output: "?q=public/filedownload&id=11076&filename=eb0ee12cde07910144e3059177c42b9b46884e77368510e8178bd486b3a0748c"

        var_dump( $avatar->getShowOnlyWhenEditable());
        // Output: false

        var_dump( $avatar->getSecurityLevelId());
        // Output: "0"

        var_dump( $avatar->getType());
        // Output: "file"

        var_dump( $avatar->getSize());
        // Output: null


```

### Delete Avatar
```php
        use CTApi\CTClient;
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;
        use CTApi\Utils\CTResponseUtil;

        FileRequest::forAvatar(23)->delete();

        $files = FileRequest::forAvatar(23)->get();
        var_dump( empty($files));
        // Output: true


```

### Rename Avatar-File
```php
        use CTApi\CTClient;
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;
        use CTApi\Utils\CTResponseUtil;

        $files = FileRequest::forAvatar(22)->get();
        $avatarFile = end($files);

        FileRequest::updateName($avatarFile, "avatar-image.png");

        var_dump( $avatarFile->getName());
        // Output: "avatar-image.png"


```

### Upload new Avatar
```php
        use CTApi\CTClient;
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;
        use CTApi\Utils\CTResponseUtil;

        $newFile = (new FileRequestBuilder("avatar", 22))->upload(__DIR__. "/../../integration/Requests/resources/avatar-1.png");

        var_dump( 23);
        // Output: $newFile->getId()

        var_dump( "avatar-1.png");
        // Output: $newFile->getName()


```
