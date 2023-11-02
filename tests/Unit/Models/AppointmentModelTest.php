<?php

namespace CTApi\Test\Unit\Models;

use CTApi\Models\Calendars\Appointment\Appointment;
use CTApi\Utils\CTDateTimeService;
use Monolog\Test\TestCase;

class AppointmentModelTest extends TestCase
{

    public function testProcessBaseAttributes()
    {
        $dataA = [
            "base" => [
                "id" => 848,
                "caption" => "Service",
                "startDate" => "2022-08-07T15:00:00Z",
                "endDate" => "2022-08-07T16:00:00Z",
            ],
        ];

        $appointment = Appointment::createModelFromData($dataA);

        $this->assertEquals(848, $appointment->getId());
        $this->assertEquals("Service", $appointment->getCaption());
        $this->assertEquals("2022-08-07T15:00:00Z", $appointment->getStartDate());
        $this->assertEquals("2022-08-07T16:00:00Z", $appointment->getEndDate());
    }

    public function testOverwriteBaseAttributes()
    {
        $dataA = [
            "base" => [
                "id" => 848,
                "caption" => "Service",
                "startDate" => "2022-08-07T15:00:00Z",
                "endDate" => "2022-08-07T16:00:00Z",
            ],
            "calculated" => [
                "startDate" => "2022-01-07T15:00:00Z",
                "endDate" => "2022-01-07T16:00:00Z",
            ]
        ];

        $appointment = Appointment::createModelFromData($dataA);

        $this->assertEquals(848, $appointment->getId());
        $this->assertEquals("Service", $appointment->getCaption());
        $this->assertEquals("2022-01-07T15:00:00Z", $appointment->getStartDate());
        $this->assertEquals("2022-01-07T16:00:00Z", $appointment->getEndDate());
    }

    public function testOverwriteBaseAttributes_WrongOrder()
    {
        $dataA = [
            "calculated" => [
                "startDate" => "2022-01-07T15:00:00Z",
                "endDate" => "2022-01-07T16:00:00Z",
            ],
            "base" => [
                "id" => 848,
                "caption" => "Service",
                "startDate" => "2022-08-07T15:00:00Z",
                "endDate" => "2022-08-07T16:00:00Z",
            ]
        ];

        $appointment = Appointment::createModelFromData($dataA);

        $this->assertEquals(848, $appointment->getId());
        $this->assertEquals("Service", $appointment->getCaption());
        $this->assertEquals("2022-01-07T15:00:00Z", $appointment->getStartDate());
        $this->assertEquals("2022-01-07T16:00:00Z", $appointment->getEndDate());

        $this->assertEquals(CTDateTimeService::stringToDateTime("2022-01-07T15:00:00Z"), $appointment->getStartDateAsDateTime());
        $this->assertEquals(CTDateTimeService::stringToDateTime("2022-01-07T16:00:00Z"), $appointment->getEndDateAsDateTime());

        // Advanced properties base / calculated
        $this->assertEquals("2022-01-07T15:00:00Z", $appointment->getCalculatedStartDate());
        $this->assertEquals("2022-01-07T16:00:00Z", $appointment->getCalculatedEndDate());
        $this->assertEquals(CTDateTimeService::stringToDateTime("2022-01-07T15:00:00Z"), $appointment->getCalculatedStartDateAsDateTime());
        $this->assertEquals(CTDateTimeService::stringToDateTime("2022-01-07T16:00:00Z"), $appointment->getCalculatedEndDateAsDateTime());

        $this->assertEquals("2022-08-07T15:00:00Z", $appointment->getBaseStartDate());
        $this->assertEquals("2022-08-07T16:00:00Z", $appointment->getBaseEndDate());
        $this->assertEquals(CTDateTimeService::stringToDateTime("2022-08-07T15:00:00Z"), $appointment->getBaseStartDateAsDateTime());
        $this->assertEquals(CTDateTimeService::stringToDateTime("2022-08-07T16:00:00Z"), $appointment->getBaseEndDateAsDateTime());
    }
}