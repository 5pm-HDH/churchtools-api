<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\Models\Events\Song\SongArrangement;
use CTApi\Models\Events\Song\SongArrangementRequest;
use CTApi\Models\Events\Song\SongRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;


class SongArrangementUpdateRequestTest extends TestCaseAuthenticated
{
    private ?string $initName;
    private ?string $initKey;
    private ?string $initBpm;
    private ?string $initBeat;
    private ?string $initDuration;
    private ?string $initNote;

    private SongArrangement $arrangement;

    protected function setUp(): void
    {
        parent::setUp();
        $this->arrangement = $this->requestSongArrangement();

        $this->initName = $this->arrangement->getName();
        $this->initKey = $this->arrangement->getKeyOfArrangement();
        $this->initBpm = $this->arrangement->getBpm();
        $this->initBeat = $this->arrangement->getBeat();
        $this->initDuration = $this->arrangement->getDuration();
        $this->initNote = $this->arrangement->getNote();
    }

    protected function tearDown(): void
    {
        $arrangement = $this->requestSongArrangement();
        $arrangement->setName($this->initName)
            ->setKeyOfArrangement($this->initKey)
            ->setBpm($this->initBpm)
            ->setBeat($this->initBeat)
            ->setDuration($this->initDuration)
            ->setNote($this->initNote);
        SongArrangementRequest::update($arrangement);

        $arrangementReloaded = $this->requestSongArrangement();
        $this->assertEquals($this->initName, $arrangementReloaded->getName());
        $this->assertEquals($this->initKey, $arrangementReloaded->getKeyOfArrangement());
        $this->assertEquals($this->initBpm, $arrangementReloaded->getBpm());
        $this->assertEquals($this->initBeat, $arrangementReloaded->getBeat());
        $this->assertEquals($this->initDuration, $arrangementReloaded->getDuration());
        $this->assertEquals($this->initNote, $arrangementReloaded->getNote());
    }

    public function testUpdateArrangement()
    {
        // Update Arrangement
        $this->arrangement->setName("D-Dur via CT-API")
            ->setKeyOfArrangement("D")
            ->setBpm("101")
            ->setBeat("6/4")
            ->setDuration("140")
            ->setNote("Hello Test Note");

        SongArrangementRequest::update($this->arrangement);

        $this->arrangement = $this->requestSongArrangement();

        $this->assertEquals("D-Dur via CT-API", $this->arrangement->getName());
        $this->assertEquals("D", $this->arrangement->getKeyOfArrangement());
        $this->assertEquals("101", $this->arrangement->getBpm());
        $this->assertEquals("6/4", $this->arrangement->getBeat());
        $this->assertEquals("140", $this->arrangement->getDuration());
        $this->assertEquals("Hello Test Note", $this->arrangement->getNote());
    }

    private function requestSongArrangement(): SongArrangement
    {
        $songId = IntegrationTestData::getFilterAsInt("get_song", "song_id");
        $song = SongRequest::findOrFail($songId);
        $arrangements = $song->getArrangements();
        $this->assertNotEmpty($arrangements);
        $arrangement = end($arrangements);
        return $arrangement;
    }
}