<?php


namespace CTApi\Requests;


use CTApi\Models\Appointment;
use CTApi\Models\ResourceBooking;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;

class AppointmentRequestBuilder
{
    use WhereCondition, OrderByCondition, Pagination;

    public function __construct(
        private array $calendarIds
    )
    {
    }

    public function get(): array
    {
        $options = [
            "query" => ["calendar_ids" => $this->calendarIds]
        ];
        $this->addWhereConditionsToOption($options);
        $data = $this->collectDataFromPages("/api/calendars/appointments", $options);
        $this->orderRawData($data);

        return Appointment::createModelsFromArray($data);
    }
}