<?php

namespace CTApi\Test\Unit\Models;

use CTApi\Models\Events\SongStatistic\SongStatistic;
use PHPUnit\Framework\TestCase;

class SongStatisticTest extends TestCase
{
    private static array $DATES_AJAX = [
        [
            "date" => "2016-05-22 10:30:00",
            "category_id" => "2"
        ],
        [
            "date" => "2016-06-22 10:30:00",
            "category_id" => "1"
        ],
        [
            "date" => "2016-07-22 10:30:00",
            "category_id" => "1"
        ],
        [
            "date" => "2016-08-22 10:30:00",
            "category_id" => "3"
        ]
    ];
    private static array $DATES_RESULT = [
        [
            "date" => "2016-05-22 10:30:00",
            "calendar_id" => "2"
        ],
        [
            "date" => "2016-06-22 10:30:00",
            "calendar_id" => "1"
        ],
        [
            "date" => "2016-07-22 10:30:00",
            "calendar_id" => "1"
        ],
        [
            "date" => "2016-08-22 10:30:00",
            "calendar_id" => "3"
        ]
    ];


    public function testParseAjaxData()
    {
        $songStatistic = SongStatistic::createModelFromAjaxData("21", self::$DATES_AJAX);

        $this->assertEquals("21", $songStatistic->getArrangementId());
        // All Calendars
        $this->assertEquals(4, $songStatistic->getCount());

        // Single Calendar
        $this->assertEquals(1, $songStatistic->getCountForCalendars([3]));
        $this->assertEquals([[
            "date" => "2016-08-22 10:30:00",
            "calendar_id" => "3"
        ]], $songStatistic->getDatesForCalendars([3]));

        // Multiple Calendars
        $this->assertEquals(3, $songStatistic->getCountForCalendars([1, 2]));
        $dates = $songStatistic->getDatesForCalendars([1, 2]);
        foreach ($dates as $date) {
            $this->assertTrue($date["calendar_id"] == 1 || $date["calendar_id"] == 2);
            $this->assertTrue(in_array($date, self::$DATES_RESULT));
        }

        // Not Existing Calendar
        $this->assertEquals(0, $songStatistic->getCountForCalendars([99, 98]));
        $this->assertEmpty($songStatistic->getDatesForCalendars([99, 98]));
    }

    public function testToData()
    {
        $songStatistic = SongStatistic::createModelFromAjaxData("21", self::$DATES_AJAX);
        $data = $songStatistic->toData();

        $this->assertArrayHasKey("count", $data);
        $this->assertEquals(4, $data["count"]);
    }

}
