<?php

namespace CTApi\Models\Groups\Group;

use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class GroupSettings
{
    use FillWithData;

    protected ?bool $allowChildRegistration = null;
    protected ?bool $allowOtherRegistration = null;
    protected ?bool $allowSameEmailRegistration = null;
    protected ?bool $allowSpouseRegistration = null;
    protected ?bool $allowWaitinglist = null;
    protected ?bool $autoAccept = null;
    protected ?bool $automaticMoveUp = null;
    protected ?bool $defaultPostCommentsActive = null;
    protected ?string $defaultPostNotificationScope = null;
    protected ?string $defaultPostPlaceholderText = null;
    protected ?string $defaultPostVisibility = null;
    protected ?array $dynamicGroupRuleSet = null;
    protected ?string $dynamicGroupStatus = null;
    protected ?string $dynamicGroupUpdateFinished = null;
    protected ?string $dynamicGroupUpdateStarted = null; 
    protected ?bool $externalPostSubscriptionsEnabled = null;
    protected array $groupMeeting = [];
    protected ?bool $inStatistic = null;
    protected ?bool $informLeader = null;
    protected ?bool $isHidden = null;
    protected ?bool $isOpenForMembers = null;
    protected ?bool $isPublic = null;
    protected array $newMember = [];
    protected ?bool $postsEnabled = null;
    protected ?bool $qrCodeCheckin = null;
    protected ?bool $qrCodeCheckinAutomaticEmail = null; 
    protected ?bool $showStreet = null;
    protected ?string $signUpClosingDate = null; 
    protected ?string $signUpHeadline = null;
    protected ?string $signUpOpeningDate = null; 
    protected ?string $visibility = null;
    protected ?string $waitinglistMaxPersons = null;
    
    /**
     * @return bool|null
     */
    public function getIsHidden(): ?bool
    {
        return $this->isHidden;
    }

    /**
     * @param bool|null $isHidden
     * @return GroupSettings
     */
    public function setIsHidden(?bool $isHidden): GroupSettings
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsOpenForMembers(): ?bool
    {
        return $this->isOpenForMembers;
    }

    /**
     * @param bool|null $isOpenForMembers
     * @return GroupSettings
     */
    public function setIsOpenForMembers(?bool $isOpenForMembers): GroupSettings
    {
        $this->isOpenForMembers = $isOpenForMembers;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowSpouseRegistration(): ?bool
    {
        return $this->allowSpouseRegistration;
    }

    /**
     * @param bool|null $allowSpouseRegistration
     * @return GroupSettings
     */
    public function setAllowSpouseRegistration(?bool $allowSpouseRegistration): GroupSettings
    {
        $this->allowSpouseRegistration = $allowSpouseRegistration;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowChildRegistration(): ?bool
    {
        return $this->allowChildRegistration;
    }

    /**
     * @param bool|null $allowChildRegistration
     * @return GroupSettings
     */
    public function setAllowChildRegistration(?bool $allowChildRegistration): GroupSettings
    {
        $this->allowChildRegistration = $allowChildRegistration;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowSameEmailRegistration(): ?bool
    {
        return $this->allowSameEmailRegistration;
    }

    /**
     * @param bool|null $allowSameEmailRegistration
     * @return GroupSettings
     */
    public function setAllowSameEmailRegistration(?bool $allowSameEmailRegistration): GroupSettings
    {
        $this->allowSameEmailRegistration = $allowSameEmailRegistration;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowOtherRegistration(): ?bool
    {
        return $this->allowOtherRegistration;
    }

    /**
     * @param bool|null $allowOtherRegistration
     * @return GroupSettings
     */
    public function setAllowOtherRegistration(?bool $allowOtherRegistration): GroupSettings
    {
        $this->allowOtherRegistration = $allowOtherRegistration;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAutoAccept(): ?bool
    {
        return $this->autoAccept;
    }

    /**
     * @param bool|null $autoAccept
     * @return GroupSettings
     */
    public function setAutoAccept(?bool $autoAccept): GroupSettings
    {
        $this->autoAccept = $autoAccept;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowWaitinglist(): ?bool
    {
        return $this->allowWaitinglist;
    }

    /**
     * @param bool|null $allowWaitinglist
     * @return GroupSettings
     */
    public function setAllowWaitinglist(?bool $allowWaitinglist): GroupSettings
    {
        $this->allowWaitinglist = $allowWaitinglist;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWaitinglistMaxPersons(): ?string
    {
        return $this->waitinglistMaxPersons;
    }

    /**
     * @param string|null $waitinglistMaxPersons
     * @return GroupSettings
     */
    public function setWaitinglistMaxPersons(?string $waitinglistMaxPersons): GroupSettings
    {
        $this->waitinglistMaxPersons = $waitinglistMaxPersons;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAutomaticMoveUp(): ?bool
    {
        return $this->automaticMoveUp;
    }

    /**
     * @param bool|null $automaticMoveUp
     * @return GroupSettings
     */
    public function setAutomaticMoveUp(?bool $automaticMoveUp): GroupSettings
    {
        $this->automaticMoveUp = $automaticMoveUp;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    /**
     * @param bool|null $isPublic
     * @return GroupSettings
     */
    public function setIsPublic(?bool $isPublic): GroupSettings
    {
        $this->isPublic = $isPublic;
        return $this;
    }

    /**
     * @return array
     */
    public function getGroupMeeting(): array
    {
        return $this->groupMeeting;
    }

    /**
     * @param array $groupMeeting
     * @return GroupSettings
     */
    public function setGroupMeeting(array $groupMeeting): GroupSettings
    {
        $this->groupMeeting = $groupMeeting;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getQrCodeCheckin(): ?bool
    {
        return $this->qrCodeCheckin;
    }

    /**
     * @param bool|null $qrCodeCheckin
     * @return GroupSettings
     */
    public function setQrCodeCheckin(?bool $qrCodeCheckin): GroupSettings
    {
        $this->qrCodeCheckin = $qrCodeCheckin;
        return $this;
    }

    /**
     * @return array
     */
    public function getNewMember(): array
    {
        return $this->newMember;
    }

    /**
     * @param array $newMember
     * @return GroupSettings
     */
    public function setNewMember(array $newMember): GroupSettings
    {
        $this->newMember = $newMember;
        return $this;
    }
    
    /**
     * @return ?bool
     */
    public function getDefaultPostCommentsActive(): ?bool
    {
        return $this->defaultPostCommentsActive;
    }
    
    /**
     * @param ?bool $defaultPostCommentsActive
     * @return GroupSettings
     */
    public function setDefaultPostCommentsActive(?bool $defaultPostCommentsActive): GroupSettings
    {
        $this->defaultPostCommentsActive = $defaultPostCommentsActive;
        return $this;
    }
    
    /**
     * @return ?string
     */
    public function getDefaultPostNotificationScope(): ?string
    {
        return $this->defaultPostNotificationScope;
    }
    
    /**
     * @param ?string $defaultPostNotificationScope
     * @return GroupSettings
     */
    public function setDefaultPostNotificationScope(?string $defaultPostNotificationScope): GroupSettings
    {
        $this->defaultPostNotificationScope = $defaultPostNotificationScope;
        return $this;
    }
    
    /**
     * @return ?string
     */
    public function getDefaultPostPlaceholderText(): ?string
    {
        return $this->defaultPostPlaceholderText;
    }
    
    /**
     * @param ?string $defaultPostPlaceholderText
     * @return GroupSettings
     */
    public function setDefaultPostPlaceholderText(?string $defaultPostPlaceholderText): GroupSettings
    {
        $this->defaultPostPlaceholderText = $defaultPostPlaceholderText;
        return $this;
    }
    
    /**
     * @return ?string
     */
    public function getDefaultPostVisibility(): ?string
    {
        return $this->defaultPostVisibility;
    }
    
    /**
     * @param ?string $defaultPostVisibility
     * @return GroupSettings
     */
    public function setDefaultPostVisibility(?string $defaultPostVisibility): GroupSettings
    {
        $this->defaultPostVisibility = $defaultPostVisibility;
        return $this;
    }
    
    /**
     * @return ?array
     */
    public function getDynamicGroupRuleSet(): ?array
    {
        return $this->dynamicGroupRuleSet;
    }
    
    /**
     * @param ?array $dynamicGroupRuleSet
     * @return GroupSettings
     */
    public function setDynamicGroupRuleSet(?array $dynamicGroupRuleSet): GroupSettings
    {
        $this->dynamicGroupRuleSet = $dynamicGroupRuleSet;
        return $this;
    }
    
    /**
     * @return ?string
     */
    public function getDynamicGroupStatus(): ?string
    {
        return $this->dynamicGroupStatus;
    }
    
    /**
     * @param ?string $dynamicGroupStatus
     * @return GroupSettings
     */
    public function setDynamicGroupStatus(?string $dynamicGroupStatus): GroupSettings
    {
        $this->dynamicGroupStatus = $dynamicGroupStatus;
        return $this;
    }
    
    /**
     * @return ?string
     */
    public function getDynamicGroupUpdateFinished(): ?string
    {
        return $this->dynamicGroupUpdateFinished;
    }
    
    /**
     * @param ?string $dynamicGroupUpdateFinished
     * @return GroupSettings
     */
    public function setDynamicGroupUpdateFinished(?string $dynamicGroupUpdateFinished): GroupSettings
    {
        $this->dynamicGroupUpdateFinished = $dynamicGroupUpdateFinished;
        return $this;
    }
    
    public function getDynamicGroupUpdateFinishedAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dynamicGroupUpdateFinished);
    }
    
    /**
     * @return ?string
     */
    public function getDynamicGroupUpdateStarted(): ?string
    {
        return $this->dynamicGroupUpdateStarted;
    }
    
    /**
     * @param ?string $dynamicGroupUpdateStarted
     * @return GroupSettings
     */
    public function setDynamicGroupUpdateStarted(?string $dynamicGroupUpdateStarted): GroupSettings
    {
        $this->dynamicGroupUpdateStarted = $dynamicGroupUpdateStarted;
        return $this;
    }
    
    public function getDynamicGroupUpdateStartedAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dynamicGroupUpdateStarted);
    }
    
    /**
     * @return ?bool
     */
    public function getExternalPostSubscriptionsEnabled(): ?bool
    {
        return $this->externalPostSubscriptionsEnabled;
    }
    
    /**
     * @param ?bool $externalPostSubscriptionsEnabled
     * @return GroupSettings
     */
    public function setExternalPostSubscriptionsEnabled(?bool $externalPostSubscriptionsEnabled): GroupSettings
    {
        $this->externalPostSubscriptionsEnabled = $externalPostSubscriptionsEnabled;
        return $this;
    }
    
    /**
     * @return ?bool
     */
    public function getInStatistic(): ?bool
    {
        return $this->inStatistic;
    }
    
    /**
     * @param ?bool $inStatistic
     * @return GroupSettings
     */
    public function setInStatistic(?bool $inStatistic): GroupSettings
    {
        $this->inStatistic = $inStatistic;
        return $this;
    }
    
    /**
     * @return ?bool
     */
    public function getInformLeader(): ?bool
    {
        return $this->informLeader;
    }
    
    /**
     * @param ?bool $inStatistic
     * @return GroupSettings
     */
    public function setInformLeader(?bool $informLeader): GroupSettings
    {
        $this->informLeader = $informLeader;
        return $this;
    }
    
    /**
     * @return ?bool
     */
    public function getPostsEnabled(): ?bool
    {
        return $this->postsEnabled;
    }
    
    /**
     * @param ?bool $inStatistic
     * @return GroupSettings
     */
    public function setPostsEnabled(?bool $postsEnabled): GroupSettings
    {
        $this->postsEnabled = $postsEnabled;
        return $this;
    }
    
    /**
     * @return ?bool
     */
    public function getQrCodeCheckinAutomaticEmail(): ?bool
    {
        return $this->qrCodeCheckinAutomaticEmail;
    }
    
    /**
     * @param ?bool $qrCodeCheckinAutomaticEmail
     * @return GroupSettings
     */
    public function setQrCodeCheckinAutomaticEmail(?bool $qrCodeCheckinAutomaticEmail): GroupSettings
    {
        $this->qrCodeCheckinAutomaticEmail = $qrCodeCheckinAutomaticEmail;
        return $this;
    }
    
    /**
     * @return ?bool
     */
    public function getShowStreet(): ?bool
    {
        return $this->showStreet;
    }
    
    /**
     * @param ?bool $showStreet
     * @return GroupSettings
     */
    public function setShowStreet(?bool $showStreet): GroupSettings
    {
        $this->showStreet = $showStreet;
        return $this;
    }
    
    /**
     * @return ?string
     */
    public function getSignUpClosingDate(): ?string
    {
        return $this->signUpClosingDate;
    }
    
    /**
     * @param ?string $signUpClosingDate
     * @return GroupSettings
     */
    public function setSignUpClosingDate(?string $signUpClosingDate): GroupSettings
    {
        $this->signUpClosingDate = $signUpClosingDate;
        return $this;
    }
    
    public function getSignUpClosingDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->signUpClosingDate);
    }
    
    /**
     * @return ?string
     */
    public function getSignUpHeadline(): ?string
    {
        return $this->signUpHeadline;
    }
    
    /**
     * @param ?string $signUpClosingDate
     * @return GroupSettings
     */
    public function setSignUpHeadline(?string $signUpHeadline): GroupSettings
    {
        $this->signUpHeadline = $signUpHeadline;
        return $this;
    }
    
    /**
     * @return ?string
     */
    public function getSignUpOpeningDate(): ?string
    {
        return $this->signUpOpeningDate;
    }
    
    /**
     * @param ?string $signUpOpeningDate
     * @return GroupSettings
     */
    public function setSignUpOpeningDate(?string $signUpOpeningDate): GroupSettings
    {
        $this->signUpOpeningDate = $signUpOpeningDate;
        return $this;
    }
    
    public function getSignUpOpeningDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->signUpOpeningDate);
    }
    
    /**
     * @return ?string
     */
    public function getVisibility(): ?string
    {
        return $this->visibility;
    }
    
    /**
     * @param ?string $visibility
     * @return GroupSettings
     */
    public function setVisibility(?string $visibility): GroupSettings
    {
        $this->visibility = $visibility;
        return $this;
    }
}
