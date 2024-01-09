<?php

namespace CTApi\Models\Calendars\CombinedAppointment;

use CTApi\Traits\Request\OrderByCondition;
use CTApi\Traits\Request\Pagination;
use CTApi\Traits\Request\WhereCondition;

class CombinedAppointmentRequestBuilder
{
    use WhereCondition;
    use OrderByCondition;
    use Pagination;

    public function __construct(
        private int $calendarId,
        private int $appointmentId,
        private String $startDate
    ) {
    }

    public function get(): CombinedAppointment
    {
        $data = $this->collectDataFromPages("/api/calendars/". $this->calendarId ."/appointments/". $this->appointmentId ."/". $this->startDate);

        return CombinedAppointment::createModelFromData($data);
    }
}
