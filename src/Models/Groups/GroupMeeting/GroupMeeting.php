<?php


namespace CTApi\Models\Groups\GroupMeeting;


use CTApi\Models\AbstractModel;
use CTApi\Models\Common\Domain\Meta;
use CTApi\Traits\Model\FillWithData;
use CTApi\Traits\Model\MetaAttribute;
use CTApi\Utils\CTDateTimeService;

class GroupMeeting extends AbstractModel
{
    use FillWithData, MetaAttribute;

    protected ?int $groupId = null;
    protected ?string $dateFrom = null;
    protected ?string $dateTo = null;
    protected ?bool $isCompleted = null;
    protected ?bool $isCanceled = null;
    protected ?bool $hasEditingStarted = null;
    protected ?int $numGuests = null;
    protected ?string $comment = null;
    protected ?string $pollResult = null;
    protected ?GroupMeetingStatistics $statistics = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "statistics":
                $this->statistics = GroupMeetingStatistics::createModelFromData($data);
                break;
            case "meta":
                $this->meta = Meta::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    public function requestMembers(): ?GroupMeetingMemberRequestBuilder
    {
        if (!is_null($this->getId()) && !is_null($this->groupId)) {
            return new GroupMeetingMemberRequestBuilder($this->groupId, $this->getIdAsInteger());
        }
        return null;
    }

    public function getDateFromAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dateFrom);
    }

    public function getDateToAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dateTo);
    }

    /**
     * @param string|null $id
     * @return GroupMeeting
     */
    public function setId(?string $id): GroupMeeting
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int|null $groupId
     * @return GroupMeeting
     */
    public function setGroupId(?int $groupId): GroupMeeting
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    /**
     * @param string|null $dateFrom
     * @return GroupMeeting
     */
    public function setDateFrom(?string $dateFrom): GroupMeeting
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    /**
     * @param string|null $dateTo
     * @return GroupMeeting
     */
    public function setDateTo(?string $dateTo): GroupMeeting
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsCompleted(): ?bool
    {
        return $this->isCompleted;
    }

    /**
     * @param bool|null $isCompleted
     * @return GroupMeeting
     */
    public function setIsCompleted(?bool $isCompleted): GroupMeeting
    {
        $this->isCompleted = $isCompleted;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsCanceled(): ?bool
    {
        return $this->isCanceled;
    }

    /**
     * @param bool|null $isCanceled
     * @return GroupMeeting
     */
    public function setIsCanceled(?bool $isCanceled): GroupMeeting
    {
        $this->isCanceled = $isCanceled;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getHasEditingStarted(): ?bool
    {
        return $this->hasEditingStarted;
    }

    /**
     * @param bool|null $hasEditingStarted
     * @return GroupMeeting
     */
    public function setHasEditingStarted(?bool $hasEditingStarted): GroupMeeting
    {
        $this->hasEditingStarted = $hasEditingStarted;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumGuests(): ?int
    {
        return $this->numGuests;
    }

    /**
     * @param int|null $numGuests
     * @return GroupMeeting
     */
    public function setNumGuests(?int $numGuests): GroupMeeting
    {
        $this->numGuests = $numGuests;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     * @return GroupMeeting
     */
    public function setComment(?string $comment): GroupMeeting
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPollResult(): ?string
    {
        return $this->pollResult;
    }

    /**
     * @param string|null $pollResult
     * @return GroupMeeting
     */
    public function setPollResult(?string $pollResult): GroupMeeting
    {
        $this->pollResult = $pollResult;
        return $this;
    }

    /**
     * @return GroupMeetingStatistics|null
     */
    public function getStatistics(): ?GroupMeetingStatistics
    {
        return $this->statistics;
    }

    /**
     * @param GroupMeetingStatistics|null $statistics
     * @return GroupMeeting
     */
    public function setStatistics(?GroupMeetingStatistics $statistics): GroupMeeting
    {
        $this->statistics = $statistics;
        return $this;
    }
}