<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupInformation
{
    use FillWithData;

    protected ?string $meetingTime = null;
    protected ?array $weekday = [];
    protected ?GroupCategory $groupCategory = null;
    protected ?array $ageGroups = [];
    protected ?TargetGroup $targetGroup = null;
    protected ?string $note = null;
    protected ?string $imageUrl = null;
    protected ?array $groupPlaces = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "groupCategory":
                $this->groupCategory = GroupCategory::createModelFromData($data);
                break;
            case "targetGroup":
                $this->targetGroup = TargetGroup::createModelFromData($data);
                break;
            case "groupPlaces":
                $this->groupPlaces = GroupPlace::createModelsFromArray($data);
                break;
            default:
                $this->{$key} = $data;
        }
    }

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
    public function getGroupPlaces(): ?array
    {
        return $this->groupPlaces;
    }

    /**
     * @param array|null $groupPlaces
     * @return GroupInformation
     */
    public function setGroupPlaces(?array $groupPlaces): GroupInformation
    {
        $this->groupPlaces = $groupPlaces;
        return $this;
    }

    /**
     * @return GroupCategory|null
     */
    public function getGroupCategory(): ?GroupCategory
    {
        return $this->groupCategory;
    }

    /**
     * @param GroupCategory|null $groupCategory
     * @return GroupInformation
     */
    public function setGroupCategory(?GroupCategory $groupCategory): GroupInformation
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
     * @return TargetGroup|null
     */
    public function getTargetGroup(): ?TargetGroup
    {
        return $this->targetGroup;
    }

    /**
     * @param TargetGroup|null $targetGroup
     * @return GroupInformation
     */
    public function setTargetGroup(?TargetGroup $targetGroup): GroupInformation
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