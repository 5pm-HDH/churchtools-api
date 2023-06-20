<?php


namespace Tests\Integration\Requests;


use CTApi\Models\SongStatistic;
use CTApi\Requests\SongRequest;
use CTApi\Requests\SongStatisticRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class SongStatisticRequestTest extends TestCaseAuthenticated
{
    private int $songId;
    private int $arrangementId;

    private string $date;
    private int $calendar;

    protected function setUp(): void
    {
        $this->songId = IntegrationTestData::getFilterAsInt("get_song_statistics", "song_id");
        $this->arrangementId = IntegrationTestData::getFilterAsInt("get_song_statistics", "arrangement_id");
        $this->date = IntegrationTestData::getResult("get_song_statistics", "any_date.date");
        $this->calendar = IntegrationTestData::getResultAsInt("get_song_statistics", "any_date.calendar_id");
    }

    public function testRequestAll()
    {
        $data = SongStatisticRequest::all();
        $this->assertNotEmpty($data);

        $lastSongStatisticElement = end($data);
        $this->assertNotEmpty($lastSongStatisticElement);
        $this->assertInstanceOf(SongStatistic::class, $lastSongStatisticElement);

        $foundDate = null;
        foreach ($data as $songStatistic) {
            if (is_a($songStatistic, SongStatistic::class)) {
                $foundDateInStatistic = $this->findDateArray($songStatistic, $this->date);
                if ($foundDateInStatistic != null) {
                    $foundDate = $foundDateInStatistic;
                }
            }
        }

        $this->assertNotNull($foundDate);
        $this->assertEquals($this->calendar, $foundDate["calendar_id"]);
    }

    public function testRequestSong()
    {
        $song = SongRequest::findOrFail($this->songId);
        $foundArrangement = null;
        foreach ($song->getArrangements() as $arrangement) {
            if ($arrangement->getIdAsInteger() == $this->arrangementId) {
                $foundArrangement = $arrangement;
            }
        }
        $this->assertNotNull($foundArrangement);

        $songStatistic = $foundArrangement->requestSongStatistic();

        $this->assertNotNull($songStatistic);
        $this->assertEquals($songStatistic->getCount(), sizeof($songStatistic->getDates()));

        $foundDate = $this->findDateArray($songStatistic, $this->date, $this->calendar);
        $this->assertNotNull($foundDate);
    }

    private function findDateArray(SongStatistic $songStatistic, string $dateString, ?int $calendarId = null): ?array
    {
        if ($calendarId == null) {
            $dates = $songStatistic->getDates();
        } else {
            $dates = $songStatistic->getDatesForCalendars([$calendarId]);
        }
        foreach ($dates as $date) {
            if ($date["date"] == $dateString) {
                return $date;
            }
        }
        return null;
    }
}