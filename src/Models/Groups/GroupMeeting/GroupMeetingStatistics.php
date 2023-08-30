<?php


namespace CTApi\Models\Groups\GroupMeeting;


use CTApi\Traits\Model\FillWithData;

class GroupMeetingStatistics
{
    use FillWithData;

    protected ?int $present = null;
    protected ?int $absent = null;
    protected ?int $unsure = null;

    /**
     * @return int|null
     */
    public function getPresent(): ?int
    {
        return $this->present;
    }

    /**
     * @param int|null $present
     * @return GroupMeetingStatistics
     */
    public function setPresent(?int $present): GroupMeetingStatistics
    {
        $this->present = $present;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAbsent(): ?int
    {
        return $this->absent;
    }

    /**
     * @param int|null $absent
     * @return GroupMeetingStatistics
     */
    public function setAbsent(?int $absent): GroupMeetingStatistics
    {
        $this->absent = $absent;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUnsure(): ?int
    {
        return $this->unsure;
    }

    /**
     * @param int|null $unsure
     * @return GroupMeetingStatistics
     */
    public function setUnsure(?int $unsure): GroupMeetingStatistics
    {
        $this->unsure = $unsure;
        return $this;
    }
}