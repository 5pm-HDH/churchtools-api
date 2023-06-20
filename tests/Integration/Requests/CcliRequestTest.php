<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\Requests\CcliRequestBuilder;
use CTApi\Requests\FileRequest;
use CTApi\Test\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class CcliRequestTest extends TestCaseAuthenticated
{
    private int $ccliId;
    private int $songArrangementId;
    private string $songArrangementKey;
    private string $songArrangementTitle;

    protected function setUp(): void
    {
        parent::setUp();
        $this->markTestSkipped("CCLI is not configured on integration system.");
        $this->ccliId = 7065049;
        $this->songArrangementId = 2020;
        $this->songArrangementKey = "C";
        $this->songArrangementTitle = "Tremble";
    }

    public function testLoadLyrics()
    {
        $songLyrics = (new CcliRequestBuilder($this->ccliId))->retrieveLyrics();

        $this->assertNotNull($songLyrics);
        $this->assertNotNull($songLyrics->getTitle());
        $this->assertNotNull($songLyrics->getSongID());
        $this->assertNotNull($songLyrics->getSongNumber());
        $this->assertEquals($this->ccliId, $songLyrics->getSongNumber());
        $this->assertNotNull($songLyrics->getCclid());
        $this->assertNotNull($songLyrics->getDisclaimer());

        $this->assertNotEmpty($songLyrics->getAuthors());
        $this->assertNotEmpty($songLyrics->getCopyrights());
        $this->assertNotEmpty($songLyrics->getLyricParts());
    }

    public function testLoadLyricsInvalidCcli()
    {
        $songLyrics = (new CcliRequestBuilder(99999999))->retrieveLyrics();
        $this->assertNull($songLyrics);
    }

    public function testLoadChordsheet()
    {
        $numberOfFilesBevorRequest = sizeof(FileRequest::forSongArrangement($this->songArrangementId)->get());

        // Request Chordsheet
        $file = (new CcliRequestBuilder($this->ccliId))->retrieveChordsheet($this->songArrangementId, $this->songArrangementTitle, $this->songArrangementKey);
        $this->assertNotNull($file);
        $this->assertEquals($this->songArrangementTitle . " - " . $this->songArrangementKey . ".pdf", $file->getName());

        // One File should be added after Request
        $numberOfFilesAfterRequest = sizeof(FileRequest::forSongArrangement($this->songArrangementId)->get());
        $this->assertEquals($numberOfFilesAfterRequest, $numberOfFilesBevorRequest + 1);

        // Clean up the created File
        FileRequest::deleteFile($file);

        $numberOfFilesAfterCleanUp = sizeof(FileRequest::forSongArrangement($this->songArrangementId)->get());
        $this->assertEquals($numberOfFilesAfterCleanUp, $numberOfFilesBevorRequest);
    }
}