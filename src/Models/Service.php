<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\ServiceGroupRequest;

class Service
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $name = null;
    protected ?string $serviceGroupId = null;
    protected ?string $commentOnConfirmation = null;
    protected ?string $sortKey = null;
    protected ?bool $allowDecline = null;
    protected ?bool $allowExchange = null;
    protected ?string $comment = null;
    protected ?string $standard = null;
    protected ?string $hidePersonName = null;
    protected ?bool $sendReminderMails = null;
    protected ?bool $sendServiceRequestEmails = null;
    protected ?bool $allowControlLiveAgenda = null;
    protected ?string $groupIds = null;
    protected ?string $tagIds = null;
    protected ?string $calTextTemplate = null;
    protected ?bool $allowChat = null;

    public function requestServiceGroup(): ?ServiceGroup
    {
        if (!is_null($this->getServiceGroupId())) {
            return ServiceGroupRequest::find((int)$this->getServiceGroupId());
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return Service
     */
    public function setId(?string $id): Service
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Service
     */
    public function setName(?string $name): Service
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getServiceGroupId(): ?string
    {
        return $this->serviceGroupId;
    }

    /**
     * @param string|null $serviceGroupId
     * @return Service
     */
    public function setServiceGroupId(?string $serviceGroupId): Service
    {
        $this->serviceGroupId = $serviceGroupId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCommentOnConfirmation(): ?string
    {
        return $this->commentOnConfirmation;
    }

    /**
     * @param string|null $commentOnConfirmation
     * @return Service
     */
    public function setCommentOnConfirmation(?string $commentOnConfirmation): Service
    {
        $this->commentOnConfirmation = $commentOnConfirmation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSortKey(): ?string
    {
        return $this->sortKey;
    }

    /**
     * @param string|null $sortKey
     * @return Service
     */
    public function setSortKey(?string $sortKey): Service
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowDecline(): ?bool
    {
        return $this->allowDecline;
    }

    /**
     * @param bool|null $allowDecline
     * @return Service
     */
    public function setAllowDecline(?bool $allowDecline): Service
    {
        $this->allowDecline = $allowDecline;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowExchange(): ?bool
    {
        return $this->allowExchange;
    }

    /**
     * @param bool|null $allowExchange
     * @return Service
     */
    public function setAllowExchange(?bool $allowExchange): Service
    {
        $this->allowExchange = $allowExchange;
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
     * @return Service
     */
    public function setComment(?string $comment): Service
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStandard(): ?string
    {
        return $this->standard;
    }

    /**
     * @param string|null $standard
     * @return Service
     */
    public function setStandard(?string $standard): Service
    {
        $this->standard = $standard;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHidePersonName(): ?string
    {
        return $this->hidePersonName;
    }

    /**
     * @param string|null $hidePersonName
     * @return Service
     */
    public function setHidePersonName(?string $hidePersonName): Service
    {
        $this->hidePersonName = $hidePersonName;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSendReminderMails(): ?bool
    {
        return $this->sendReminderMails;
    }

    /**
     * @param bool|null $sendReminderMails
     * @return Service
     */
    public function setSendReminderMails(?bool $sendReminderMails): Service
    {
        $this->sendReminderMails = $sendReminderMails;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSendServiceRequestEmails(): ?bool
    {
        return $this->sendServiceRequestEmails;
    }

    /**
     * @param bool|null $sendServiceRequestEmails
     * @return Service
     */
    public function setSendServiceRequestEmails(?bool $sendServiceRequestEmails): Service
    {
        $this->sendServiceRequestEmails = $sendServiceRequestEmails;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowControlLiveAgenda(): ?bool
    {
        return $this->allowControlLiveAgenda;
    }

    /**
     * @param bool|null $allowControlLiveAgenda
     * @return Service
     */
    public function setAllowControlLiveAgenda(?bool $allowControlLiveAgenda): Service
    {
        $this->allowControlLiveAgenda = $allowControlLiveAgenda;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupIds(): ?string
    {
        return $this->groupIds;
    }

    /**
     * @param string|null $groupIds
     * @return Service
     */
    public function setGroupIds(?string $groupIds): Service
    {
        $this->groupIds = $groupIds;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTagIds(): ?string
    {
        return $this->tagIds;
    }

    /**
     * @param string|null $tagIds
     * @return Service
     */
    public function setTagIds(?string $tagIds): Service
    {
        $this->tagIds = $tagIds;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCalTextTemplate(): ?string
    {
        return $this->calTextTemplate;
    }

    /**
     * @param string|null $calTextTemplate
     * @return Service
     */
    public function setCalTextTemplate(?string $calTextTemplate): Service
    {
        $this->calTextTemplate = $calTextTemplate;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowChat(): ?bool
    {
        return $this->allowChat;
    }

    /**
     * @param bool|null $allowChat
     * @return Service
     */
    public function setAllowChat(?bool $allowChat): Service
    {
        $this->allowChat = $allowChat;
        return $this;
    }
}