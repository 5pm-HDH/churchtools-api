<?php


namespace Tests\Unit\Utils;


use CTApi\Utils\CTDateTimeService;
use PHPUnit\Framework\TestCase;

class CTDateTimeServiceTest extends TestCase
{
    /**
     * @dataProvider provideReallifeChurchToolsDates
     */
    public function testReallifeData($rawDateString, $assertedDate, $assertedUnixTimestamp, bool $strictFormat)
    {
        $date = CTDateTimeService::stringToDateTime($rawDateString, $strictFormat);
        $this->assertNotNull($date, "Could not convet date: " . $rawDateString);
        $this->assertInstanceOf(\DateTimeImmutable::class, $date);
        $timestamp = $date->getTimestamp();

        $dateInFormat = $date->format("Y-m-d H:i:s");
        $this->assertEquals($assertedDate, $dateInFormat);
        $this->assertEquals($assertedUnixTimestamp, $timestamp);
    }

    public function provideReallifeChurchToolsDates()
    {
        return [
            ["2021-02-24T06:00:00Z", "2021-02-24 06:00:00", 1614146400, true],
            ["2021-09-02 20:15:00", "2021-09-02 20:15:00", 1630613700, true],
            ["2022-11-13T16:00:00.000000Z", "2022-11-13 16:00:00", 1668355200, true],

            ["2025-02-24", "2025-02-24 00:00:00", 1740355200, false],
            ["25.02.2020", "2020-02-25 00:00:00", 1582588800, false],
            ["25.02.2020 20:15", "2020-02-25 20:15:00", 1582661700, false],
        ];
    }

    /**
     * @dataProvider provideInvalidDates
     */
    public function testInvalidDates($invalidDateValues)
    {
        $strictDate = CTDateTimeService::stringToDateTime($invalidDateValues, true);
        $this->assertNull($strictDate);

        $notStrictDate = CTDateTimeService::stringToDateTime($invalidDateValues, false);
        $this->assertNull($notStrictDate);
    }

    public function provideInvalidDates()
    {
        return [
            ["invalid dates"],
            [""],
            ["2020-02-01 invalid dates"]
        ];
    }
}