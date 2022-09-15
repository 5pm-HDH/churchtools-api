# FileAPI

## Available Domain-Types:

The FileRequestBuilder can be accessed via the FileRequest-Facade:

```php
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;

        FileRequest::forAvatar(21);
        FileRequest::forGroupImage(21);
        FileRequest::forLogo(21);
        FileRequest::forAttatchment(21);
        FileRequest::forHtmlTemplate(21);
        FileRequest::forEvent(21);
        FileRequest::forSongArrangement(21);
        FileRequest::forImportTable(21);
        FileRequest::forPerson(21);
        FileRequest::forFamilyAvatar(21);

```

Or you can call the builder direct in the model. E.q. in the events-model:

```php
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;

        $event = new \CTApi\Models\Event();
        $event->requestFiles()?->get();
        $event->requestFiles()?->delete();
        // ... see methods below

```

## FileRequestBuilder-Methods:

### Get files

Returns an array with all available files. The Avatar-Route only contains one file:

```php
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;

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

### Delete all files

Deletes all files that are attached to the domain-model.

```php
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;

        FileRequest::forAvatar(23)->delete();

        $files = FileRequest::forAvatar(23)->get();
        var_dump( empty($files));
        // Output: true


```

### Delete single file

If you want to delete one specific file you can use the delete-method:

```php
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;

        $files = FileRequest::forEvent(21)->get();

        foreach ($files as $file) {
            if ($file->getName() == "birthday-kids.xlsx") {
                FileRequest::deleteFile($file);
            }
        }

```

### Rename file

```php
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;

        $files = FileRequest::forAvatar(22)->get();
        $avatarFile = end($files);

        FileRequest::updateName($avatarFile, "avatar-image.png");

        var_dump( $avatarFile->getName());
        // Output: "avatar-image.png"


```

### Upload file

The avatar-model only accepts one image. If you upload a image the current used avatare will be replaced with the
uploaded image. The Event-model e.q. also accepts multiple file-attachements.

```php
        use CTApi\Models\File;
        use CTApi\Requests\FileRequest;

        $newFile = (new FileRequestBuilder("avatar", 22))->upload(__DIR__ . "/../../integration/Requests/resources/avatar-1.png");

        var_dump( $newFile?->getId());
        // Output: 23

        var_dump( $newFile?->getName());
        // Output: "avatar-1.png"


```