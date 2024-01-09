<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Models\Events\Song\Song;
use CTApi\Models\Events\Song\SongRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class SongUpdateRequestTest extends TestCaseAuthenticated
{
    private ?string $initName;
    private ?string $initCategoryId;
    private ?bool $initPractice;
    private ?string $initAuthor;
    private ?string $initCopyright;
    private ?string $initCcli;

    private Song $song;

    protected function setUp(): void
    {
        parent::setUp();
        $this->song = $this->requestSong();

        $this->initName = $this->song->getName();
        $this->initCategoryId = $this->song->getCategory()?->getId();
        $this->initPractice = $this->song->getShouldPractice();
        $this->initAuthor = $this->song->getAuthor();
        $this->initCopyright = $this->song->getCopyright();
        $this->initCcli = $this->song->getCcli();
    }

    protected function tearDown(): void
    {
        $song = $this->requestSong();
        $song->setName($this->initName)
            ->setCategoryId($this->initCategoryId)
            ->setShouldPractice($this->initPractice)
            ->setAuthor($this->initAuthor)
            ->setCopyright($this->initCopyright)
            ->setCcli($this->initCcli);
        SongRequest::update($song);

        $songReloaded = $this->requestSong();
        $this->assertEquals($this->initName, $songReloaded->getName());
        $this->assertEquals($this->initCategoryId, $songReloaded->getCategory()?->getId());
        $this->assertEquals($this->initPractice, $songReloaded->getShouldPractice());
        $this->assertEquals($this->initAuthor, $songReloaded->getAuthor());
        $this->assertEquals($this->initCopyright, $songReloaded->getCopyright());
        $this->assertEquals($this->initCcli, $songReloaded->getCcli());
    }

    public function testUpdateSong()
    {
        // Update Arrangement
        $this->song->setName("New Song Name")
            ->setCategoryId("1")
            ->setShouldPractice(true)
            ->setAuthor("TestAuthor CT-Api")
            ->setCopyright("CT-Api Copyright")
            ->setCcli("0815");
        SongRequest::update($this->song);

        $this->song = $this->requestSong();

        $this->assertEquals("New Song Name", $this->song->getName());
        $this->assertEquals(1, $this->song->getCategory()?->getId());
        $this->assertEquals(true, $this->song->getShouldPractice());
        $this->assertEquals("TestAuthor CT-Api", $this->song->getAuthor());
        $this->assertEquals("CT-Api Copyright", $this->song->getCopyright());
        $this->assertEquals("0815", $this->song->getCcli());
    }

    private function requestSong(): Song
    {
        $songId = IntegrationTestData::getFilterAsInt("get_song", "song_id");
        return SongRequest::findOrFail($songId);
    }
}
