<?php


namespace Tests\Integration\Requests;


use CTApi\Exceptions\CTModelException;
use CTApi\Requests\FileRequest;
use CTApi\Requests\PersonRequest;
use CTApi\Requests\SongRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class FileRequestTest extends TestCaseAuthenticated
{
    private int $myselfId;
    private int $songId;
    private int $songArrangementId;

    private string $fileNameA = "avatar-image-1.jpg";
    private string $fileNameB = "avatar-image-2.jpg";

    protected function setUp(): void
    {
        parent::setUp();
        $this->checkIfTestSuiteIsEnabled("FILE_AVATAR");
        $myself = PersonRequest::whoami();
        $this->myselfId = (int)$myself->getId();
        $this->songId = (int)TestData::getValue("FILE_SONG_ID");
        $this->songArrangementId = (int)TestData::getValue("FILE_SONG_ARRANGEMENT_ID");

        $this->assertAvatarIsPresent();
    }

    public function testUploadAvatarWrongFilePath()
    {
        $this->expectException(CTModelException::class);
        $avatar = FileRequest::forAvatar($this->myselfId)->upload("random-invalid-path.jpg");
    }

    public function testDeleteAndUploadAvatar()
    {
        // Delete Avatar
        FileRequest::forAvatar($this->myselfId)->delete();
        $this->assertAvatarIsNotPresent();

        // Upload new Avatar
        $avatar = FileRequest::forAvatar($this->myselfId)->upload(__DIR__ . "/resources/avatar-1.png");
        $this->assertNotNull($avatar);
        $this->assertEquals("avatar-1.png", $avatar->getName());
        print_r($avatar);
        $this->assertAvatarIsPresent();
    }

    public function testDownloadAvatar()
    {
        $files = FileRequest::forAvatar($this->myselfId)->get();
        if (empty($files)) {
            $this->markTestSkipped("The person with id " . $this->myselfId . " has no avatar.");
        }

        $avatar = end($files);
        $avatar->setName("avatar-test-case.jpg");
        $avatar->downloadToPath(__DIR__ . "/resources/");
        $this->assertFileExists(__DIR__ . "/resources/avatar-test-case.jpg");
    }

    public function testRenameFile()
    {
        $files = FileRequest::forAvatar($this->myselfId)->get();
        $this->assertNotEmpty($files, "Could not find avatar for user.");
        $avatar = end($files);
        $this->assertNotNull($avatar);
        $newAvatarName = (($avatar->getName() == $this->fileNameA) ? $this->fileNameB : $this->fileNameA);

        FileRequest::updateName($avatar, $newAvatarName);

        $this->assertEquals($newAvatarName, $avatar->getName());

        // Reload File
        $filesReloaded = FileRequest::forAvatar($this->myselfId)->get();
        $avatarReloaded = end($filesReloaded);
        $this->assertNotNull($avatarReloaded);
        $this->assertEquals($newAvatarName, $avatarReloaded->getName());
    }

    private function assertAvatarIsPresent()
    {
        $filesReloaded = FileRequest::forAvatar($this->myselfId)->get();
        $this->assertNotEmpty($filesReloaded, "Avatar for user " . $this->myselfId . " is not present.");
        $avatarReloaded = end($filesReloaded);
        $this->assertNotNull($avatarReloaded);
    }

    private function assertAvatarIsNotPresent()
    {
        $filesReloaded = FileRequest::forAvatar($this->myselfId)->get();
        $this->assertEmpty($filesReloaded);
    }

    public function testGetMultipleFilesOfSongArrangement()
    {
        $song = SongRequest::findOrFail($this->songId);

        $arrangement = null;
        foreach ($song->getArrangements() as $arrangementItem) {
            if ($arrangementItem->getId() == $this->songArrangementId) {
                $arrangement = $arrangementItem;
            }
        }
        $this->assertNotNull($arrangement, "Could not find Arrangement with id " . $this->songArrangementId . " in song: " . $this->songId);

        $files = FileRequest::forSongArrangement($this->songArrangementId)->get();
        $this->assertTrue(sizeof($files) > 1, "Arrangement contains less than 2 files.");
    }
}