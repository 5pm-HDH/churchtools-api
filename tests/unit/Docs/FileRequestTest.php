<?php


namespace Tests\Unit\Docs;


use CTApi\CTClient;
use CTApi\Models\File;
use CTApi\Requests\FileRequest;
use CTApi\Utils\CTResponseUtil;
use Tests\Unit\TestCaseHttpMocked;

class FileRequestTest extends TestCaseHttpMocked
{

    public function testShowAvatar()
    {
        $files = FileRequest::forAvatar(21)->get();
        $avatar = end($files);

        $this->assertEquals(23, $avatar->getId());
        $this->assertEquals("avatar", $avatar->getDomainType());
        $this->assertEquals("41", $avatar->getDomainId());
        $this->assertEquals("avatar-1.png", $avatar->getName());
        $this->assertEquals("eb0ee12cde07910144e3059177c42b9b46884e77368510e8178bd486b3a0748c", $avatar->getFilename());
        $this->assertEquals("https://intern.church.tools/?q=public/filedownload&id=11076&filename=eb0ee12cde07910144e3059177c42b9b46884e77368510e8178bd486b3a0748c", $avatar->getFileUrl());
        $this->assertEquals("https://intern.church.tools/images/11076/fc95ccae02311467801819503fae71db26a4dc18e19e4eca916d30831db161c2", $avatar->getImageUrl());
        $this->assertEquals("?q=public/filedownload&id=11076&filename=eb0ee12cde07910144e3059177c42b9b46884e77368510e8178bd486b3a0748c", $avatar->getRelativeUrl());
        $this->assertEquals(false, $avatar->getShowOnlyWhenEditable());
        $this->assertEquals("0", $avatar->getSecurityLevelId());
        $this->assertEquals("file", $avatar->getType());
        $this->assertEquals(null, $avatar->getSize());
    }

    public function testDeleteAvatar()
    {
        FileRequest::forAvatar(23)->delete();

        $files = FileRequest::forAvatar(23)->get();
        $this->assertEquals(true, empty($files));
    }

    public function testRenameAvatar()
    {
        $files = FileRequest::forAvatar(22)->get();
        $avatarFile = end($files);

        FileRequest::updateName($avatarFile, "avatar-image.png");

        $this->assertEquals("avatar-image.png", $avatarFile->getName());
    }

    public function testUploadAvatar()
    {
        $newFile = (new FileRequestBuilder("avatar", 22))->upload(__DIR__. "/../../integration/Requests/resources/avatar-1.png");

        $this->assertEquals($newFile->getId(), 23);
        $this->assertEquals($newFile->getName(), "avatar-1.png");
    }

}

class FileRequestBuilder extends \CTApi\Requests\FileRequestBuilder{

    public function __construct(string $domainType, int $domainIdentifier)
    {
        parent::__construct($domainType, $domainIdentifier);
    }

    public function upload(string $filePath): ?File
    {
        $client = CTClient::getClient();
        $response = $client->post($this->getApiEndpoint());
        $data = CTResponseUtil::dataAsArray($response);
        return File::createModelFromData($data);
    }
}