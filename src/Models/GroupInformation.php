<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupInformation
{
    use FillWithData;

    protected ?string $meetingTime = null;
    protected ?array $weekday = [];
    protected ?array $groupCategory = [];
    protected ?array $ageGroups = [];
    protected ?array $targetGroup = [];
    protected ?string $note = null;
    protected ?string $imageUrl = null;

    /**
     * @return string|null
     */
    public function getMeetingTime(): ?string
    {
        return $this->meetingTime;
    }

    /**
     * @param string|null $meetingTime
     * @return GroupInformation
     */
    public function setMeetingTime(?string $meetingTime): GroupInformation
    {
        $this->meetingTime = $meetingTime;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getWeekday(): ?array
    {
        return $this->weekday;
    }

    /**
     * @param array|null $weekday
     * @return GroupInformation
     */
    public function setWeekday(?array $weekday): GroupInformation
    {
        $this->weekday = $weekday;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getGroupCategory(): ?array
    {
        return $this->groupCategory;
    }

    /**
     * @param array|null $groupCategory
     * @return GroupInformation
     */
    public function setGroupCategory(?array $groupCategory): GroupInformation
    {
        $this->groupCategory = $groupCategory;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getAgeGroups(): ?array
    {
        return $this->ageGroups;
    }

    /**
     * @param array|null $ageGroups
     * @return GroupInformation
     */
    public function setAgeGroups(?array $ageGroups): GroupInformation
    {
        $this->ageGroups = $ageGroups;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getTargetGroup(): ?array
    {
        return $this->targetGroup;
    }

    /**
     * @param array|null $targetGroup
     * @return GroupInformation
     */
    public function setTargetGroup(?array $targetGroup): GroupInformation
    {
        $this->targetGroup = $targetGroup;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     * @return GroupInformation
     */
    public function setNote(?string $note): GroupInformation
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     * @return GroupInformation
     */
    public function setImageUrl(?string $imageUrl): GroupInformation
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }
}