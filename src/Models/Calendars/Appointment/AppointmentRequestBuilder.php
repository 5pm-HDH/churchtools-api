<?php


namespace CTApi\Models\Calendars\Appointment;


use CTApi\Traits\Request\OrderByCondition;
use CTApi\Traits\Request\Pagination;
use CTApi\Traits\Request\WhereCondition;

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