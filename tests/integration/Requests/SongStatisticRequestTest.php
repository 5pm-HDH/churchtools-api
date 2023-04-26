<?php


namespace Tests\Integration\Requests;


use CTApi\CTLog;
use CTApi\Models\SongStatistic;
use CTApi\Requests\SongRequest;
use CTApi\Requests\SongStatisticRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class SongStatisticRequestTest extends TestCaseAuthenticated
{
    private int $songId;

    protected function setUp(): void
    {
        if (!TestData::getValue("SONG_STATISTICS") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }
        $this->songId = TestData::getValueAsInteger("SONG_STATISTICS_SONG_ID");
    }

    public function testRequestAll()
    {
        $data = SongStatisticRequest::all();

        $this->assertNotEmpty($data);

        $lastSongStatisticElement = end($data);
        $this->assertNotEmpty($lastSongStatisticElement);
        $this->assertInstanceOf(SongStatistic::class, $lastSongStatisticElement);
    }

    public function testRequestSong()
    {
        CTLog::enableHttpLog();
        $song = SongRequest::findOrFail($this->songId);
        $songStatistic = $song->requestSongStatistic();

        $this->assertNotNull($songStatistic);
        $this->assertEquals($songStatistic->getCount(), sizeof($songStatistic->getDates()));
    }
}