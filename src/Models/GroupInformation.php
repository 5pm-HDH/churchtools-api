<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Utils\CTDateTimeService;
use CTApi\Models\Traits\HasDBFields;

class GroupInformation
{
    use FillWithData, HasDBFields;

    protected ?string $meetingTime = null;
    protected ?array $weekday = [];
    protected ?GroupCategory $groupCategory = null;
    protected ?array $ageGroups = [];
    protected ?TargetGroup $targetGroup = null;
    protected ?string $note = null;
    protected ?string $imageUrl = null;
    protected ?array $groupPlaces = null;
    protected ?string $groupHomepageUrl = null;
    protected ?int $groupStatusId = null;
    protected ?int $groupTypeId = null;
    protected ?string $dateOfFoundation = null;
    protected ?string $endDate = null;
    protected ?int $groupCategoryId = null;
    protected array $ageGroupIds = [];
    protected ?int $targetGroupId = null;
    protected ?int $maxMembers = null;
    protected ?int $campusId = null;
    protected ?string $chatStatus = null;
    protected ?int $signUpOverrideRoleId = null;

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
                $this->fillDefault($key, $data);
        }
    }

    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "weekday":
                $this->weekday = [$value];
                break;
            default:
                $this->fillDefault($key, $value);
        }
    }

    public function toData(): array
    {
        $data = $this->convertPropertiesToData();
        $data["imageUrlBanner"] = $this->getImageUrlBanner();
        return $data;
    }

    public function getDateOfFoundationAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dateOfFoundation);
    }

    public function getEndDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->endDate);
    }

    /**
     * @return string|null
     */
    public function getGroupHomepageUrl(): ?string
    {
        return $this->groupHomepageUrl;
    }

    /**
     * @param string|null $groupHomepageUrl
     * @return GroupInformation
     */
    public function setGroupHomepageUrl(?string $groupHomepageUrl): GroupInformation
    {
        $this->groupHomepageUrl = $groupHomepageUrl;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupStatusId(): ?int
    {
        return $this->groupStatusId;
    }

    /**
     * @param int|null $groupStatusId
     * @return GroupInformation
     */
    public function setGroupStatusId(?int $groupStatusId): GroupInformation
    {
        $this->groupStatusId = $groupStatusId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupTypeId(): ?int
    {
        return $this->groupTypeId;
    }

    /**
     * @param int|null $groupTypeId
     * @return GroupInformation
     */
    public function setGroupTypeId(?int $groupTypeId): GroupInformation
    {
        $this->groupTypeId = $groupTypeId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateOfFoundation(): ?string
    {
        return $this->dateOfFoundation;
    }

    /**
     * @param string|null $dateOfFoundation
     * @return GroupInformation
     */
    public function setDateOfFoundation(?string $dateOfFoundation): GroupInformation
    {
        $this->dateOfFoundation = $dateOfFoundation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @param string|null $endDate
     * @return GroupInformation
     */
    public function setEndDate(?string $endDate): GroupInformation
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupCategoryId(): ?int
    {
        return $this->groupCategoryId;
    }

    /**
     * @param int|null $groupCategoryId
     * @return GroupInformation
     */
    public function setGroupCategoryId(?int $groupCategoryId): GroupInformation
    {
        $this->groupCategoryId = $groupCategoryId;
        return $this;
    }

    /**
     * @return array
     */
    public function getAgeGroupIds(): array
    {
        return $this->ageGroupIds;
    }

    /**
     * @param array $ageGroupIds
     * @return GroupInformation
     */
    public function setAgeGroupIds(array $ageGroupIds): GroupInformation
    {
        $this->ageGroupIds = $ageGroupIds;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTargetGroupId(): ?int
    {
        return $this->targetGroupId;
    }

    /**
     * @param int|null $targetGroupId
     * @return GroupInformation
     */
    public function setTargetGroupId(?int $targetGroupId): GroupInformation
    {
        $this->targetGroupId = $targetGroupId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxMembers(): ?int
    {
        return $this->maxMembers;
    }

    /**
     * @param int|null $maxMembers
     * @return GroupInformation
     */
    public function setMaxMembers(?int $maxMembers): GroupInformation
    {
        $this->maxMembers = $maxMembers;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCampusId(): ?int
    {
        return $this->campusId;
    }

    /**
     * @param int|null $campusId
     * @return GroupInformation
     */
    public function setCampusId(?int $campusId): GroupInformation
    {
        $this->campusId = $campusId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getChatStatus(): ?string
    {
        return $this->chatStatus;
    }

    /**
     * @param string|null $chatStatus
     * @return GroupInformation
     */
    public function setChatStatus(?string $chatStatus): GroupInformation
    {
        $this->chatStatus = $chatStatus;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSignUpOverrideRoleId(): ?int
    {
        return $this->signUpOverrideRoleId;
    }

    /**
     * @param int|null $signUpOverrideRoleId
     * @return GroupInformation
     */
    public function setSignUpOverrideRoleId(?int $signUpOverrideRoleId): GroupInformation
    {
        $this->signUpOverrideRoleId = $signUpOverrideRoleId;
        return $this;
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
     * Return Group-Image as Banner-Format.
     * @return string|null
     */
    public function getImageUrlBanner(): ?string
    {
        if ($this->getImageUrl() != null) {
            return $this->getImageUrl() . "?p=group-tile";
        }
        return null;
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