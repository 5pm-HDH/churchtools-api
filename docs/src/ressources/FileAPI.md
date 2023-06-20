# FileAPI

## Available Domain-Types:

The FileRequestBuilder can be accessed via the FileRequest-Facade:

{{ \CTApi\Test\Unit\Docs\FileRequestTest.testAvailableDomainTypes }}

Or you can call the builder direct in the model. E.q. in the events-model:

{{ \CTApi\Test\Unit\Docs\FileRequestTest.testRequestBuilderViaModel }}

## FileRequestBuilder-Methods:

### Get files

Returns an array with all available files. The Avatar-Route only contains one file:

{{ \CTApi\Test\Unit\Docs\FileRequestTest.testShowAvatar }}

### Delete all files

Deletes all files that are attached to the domain-model.

{{ \CTApi\Test\Unit\Docs\FileRequestTest.testDeleteAvatar }}

### Delete single file

If you want to delete one specific file you can use the delete-method:

{{ \CTApi\Test\Unit\Docs\FileRequestTest.testDeleteSingleFile }}

### Rename file

{{ \CTApi\Test\Unit\Docs\FileRequestTest.testRenameAvatar }}

### Upload file

The avatar-model only accepts one image. If you upload a image the current used avatare will be replaced with the
uploaded image. The Event-model e.q. also accepts multiple file-attachements.

{{ \CTApi\Test\Unit\Docs\FileRequestTest.testUploadAvatar }}