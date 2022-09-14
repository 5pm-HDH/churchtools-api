<?php


namespace Tests\Integration\Requests;


use CTApi\Exceptions\CTModelException;
use CTApi\Requests\FileRequest;
use CTApi\Requests\PersonRequest;
use Tests\Integration\TestCaseAuthenticated;

class FileRequestTest extends TestCaseAuthenticated
{
    private int $myselfId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->checkIfTestSuiteIsEnabled("FILE_AVATAR");
        $myself = PersonRequest::whoami();
        $this->myselfId = (int)$myself->getId();
    }

    public function testDeleteAvatar()
    {
        FileRequest::forAvatar($this->myselfId)->delete();
        $avatar = FileRequest::forAvatar($this->myselfId)->get();
        $this->assertEmpty($avatar);
    }

    public function testUploadAvatarWrongFilePath()
    {
        $this->expectException(CTModelException::class);
        $avatar = FileRequest::forAvatar($this->myselfId)->upload("random-invalid-path.jpg");
    }

    public function testUploadAvatar()
    {
        $avatar = FileRequest::forAvatar($this->myselfId)->upload(__DIR__ . "/resources/avatar-1.png");
        $this->assertNotEmpty($avatar);
        // Validation-Error!
    }

    public function testDownloadAvatar()
    {
        $avatar = FileRequest::forAvatar($this->myselfId)->get();
        if (empty($avatar)) {
            $this->markTestSkipped("The person with id " . $this->myselfId . " has no avatar.");
        }

        $this->assertNotNull($avatar);
        $avatar->setName("avatar-test-case.jpg");
        $avatar->downloadToPath(__DIR__ . "/resources/");
        $this->assertFileExists(__DIR__ . "/resources/avatar-test-case.jpg");
    }
}