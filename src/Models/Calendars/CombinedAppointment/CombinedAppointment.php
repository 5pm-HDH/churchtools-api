<?php

namespace CTApi\Models\Calendars\CombinedAppointment;

use CTApi\Models\Calendars\Appointment\Appointment;
use CTApi\Models\Calendars\Resource\ResourceBooking;
use CTApi\Models\Events\Event\Event;
use CTApi\Models\Groups\Group\Group;
use CTApi\Traits\Model\FillWithData;

class CombinedAppointment
{
    use FillWithData;

    protected Appointment $appointment;
    protected ?Event $event = null;
    protected ?Group $group = null;
    protected ?array $bookings = null;
    //
    // Base class not yet implemented
    //
    //        protected array $meetingRequests= null;


    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "appointment":
                $this->appointment = Appointment::createModelFromData($data);
                break;
            case "event":
                $this->event = Event::createModelFromData($data);
                break;
            case "group":
                $this->group = Group::createModelFromData($data);
                break;
            case "bookings":
                $this->bookings = ResourceBooking::createModelsFromArray($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    /**
     * @return Appointment
     */
    public function getAppointment(): Appointment
    {
        return $this->appointment;
    }

    /**
     * @param Appointment $appointment
     * @return CombinedAppointment
     */
    public function setAppointment(Appointment $appointment): CombinedAppointment
    {
        $this->appointment = $appointment;
        return $this;
    }

    /**
     * @return Event
     */
    public function getEvent(): ?Event
    {
        return $this->event;
    }

    /**
     * @param Event|null $event
     * @return CombinedAppointment
     */
    public function setEvent(?Event $event): CombinedAppointment
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return array of ResourceBooking or NULL
     */
    public function getBookings(): ?array
    {
        return $this->bookings;
    }

    /**
     * @param array $bookings of ResourceBooking $bookings
     * @return CombinedAppointment
     */
    public function setBookings(?array $bookings): CombinedAppointment
    {
        $this->bookings = $bookings;
        return $this;
    }

    //
    //  Not yet implemented, missing MeetingRequests base class implementation
    //
    //    /**
    //     * @return array of MeetingRequest or NULL
    //     */
    //    public function getMeetingRequests(): ?array
    //    {
    //        return $this->meetingRequests;
    //    }
    //
    //    /**
    //     * @param array of MeetingRequests $meetingRequests
    //     * @return CombinedAppointment
    //     */
    //    public function setMeetingRequests(?array $meetingRequests): CombinedAppointment
    //    {
    //        $this->meetingRequests = $meetingRequests;
    //        return $this;
    //    }
    //
}
