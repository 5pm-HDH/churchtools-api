<?php


namespace CTApi\Models\Calendars\CombinedAppointment;


use CTApi\Traits\Request\OrderByCondition;
use CTApi\Traits\Request\Pagination;
use CTApi\Traits\Request\WhereCondition;

class CombinedAppointmentRequestBuilder
{
    use WhereCondition, OrderByCondition, Pagination;

    public function __construct(
        private int $calendarId,
        private int $appointmentId,
        private String $startDate
    )
    {
    }

    public function get(): array
    {
        $options = [
            "query" => ["calendar_ids" => $this->calendarIds]
        ];
        $this->addWhereConditionsToOption($options);
        $data = $this->collectDataFromPages("/api/calendars/".this->calendarId."/appointments/".this->appointmentId."/".this->startDate, $options);
        $this->orderRawData($data);

        return CombinedAppointment::createModelsFromArray($data);
    }
}