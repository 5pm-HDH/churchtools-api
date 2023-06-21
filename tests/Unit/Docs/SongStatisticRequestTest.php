<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Events\SongStatistic\SongStatisticRequest;
use CTApi\Models\Events\SongStatistic\SongStatisticRequestBuilder;
use CTApi\Test\Unit\TestCaseHttpMocked;

class SongStatisticRequestTest extends TestCaseHttpMocked
{

    public function testGetAll()
    {
        $data = SongStatisticRequest::all();

        $songStatistic = end($data);

        $this->assertEquals(14, $songStatistic->getCount());
        $this->assertEquals(11, $songStatistic->getCountForCalendars([1, 2]));

        // Retrieve Dates:
        $allDates = $songStatistic->getDates();
        $date = end($allDates);
        $this->assertEquals('2021-12-12 10:30:00', $date["date"]);
        $this->assertEquals('3', $date["calendar_id"]);

        $datesForMyServies = $songStatistic->getDatesForCalendars([1, 2]);
        $dateService = end($datesForMyServies);
        $this->assertEquals('2021-07-11 10:30:00', $dateService["date"]);
        $this->assertEquals('2', $dateService["calendar_id"]);
    }

    public function testGetViaSongArrangement()
    {
        $statistics = SongStatisticRequest::findOrFail("21");

        $this->assertEquals($statistics->getCount(), 8);
        $this->assertEquals($statistics->getCountForCalendars([2]), 5);
        $this->assertEquals($statistics->getCountForCalendars([21]), 0);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testLazy()
    {
        /**
         * Lazy-SongStatisticRequestBuilder
         */
        $requestBuilderLazy = new SongStatisticRequestBuilder(); // default: lazy-flag is true

        $requestBuilderLazy->find("21");
        $requestBuilderLazy->find("22");

        // The whole song-statistic will be fetched ones and used for both "find"-calls.

        /**
         * Not-Lazy-SongStatisticRequestBuilder
         */

        $requestBuilderNotLazy = new SongStatisticRequestBuilder(false);

        $requestBuilderLazy->find("21");
        $requestBuilderLazy->find("22");

        // The whole song-statistic will be fetched for every "find"-call.
    }

}