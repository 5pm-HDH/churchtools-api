<?php


namespace Tests\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Exceptions\CTModelException;
use CTApi\Requests\EventRequest;
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
    }

    public function testDeleteAvatar()
    {
        $this->markTestSkipped("Cannot restore Avatar after deletion.");
        // TODO: Restore Image after deletion

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
        // TODO: Implement upload mechanism.
        $this->markTestSkipped("Implementation of File-Upload is no clear yet. See PR for more details.");
        $avatar = FileRequest::forAvatar($this->myselfId)->upload(__DIR__ . "/resources/avatar-1.png");
        $this->assertNotEmpty($avatar);
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

    public function testGetMultipleFilesOfSongArrangement()
    {
        CTConfig::enableDebugging();
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

    public function testFilesForEvent()
    {
        $events = EventRequest::where("from", "2022-09-14")->where("to", "2022-09-25")->get();
        foreach($events as $event)
        {
            print_r([$event->getId(), $event->getStartDate()]);
        }

        $files = FileRequest::forEvent(7772)->get();
        print_r($files);
    }
}