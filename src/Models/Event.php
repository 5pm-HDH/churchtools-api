<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class Event
{
    use FillWithData;

    protected ?string $id;
    protected ?string $guid;
    protected ?string $name;
    protected ?string $description;
    protected ?string $startDate;
    protected ?string $endDate;
    protected ?string $chatStatus;
    protected ?array $permissions;
    protected ?array $calendar;

    protected function parseArray(string $key, array $data)
    {
        $this->{$key} = $data;
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
     * @return Event
     */
    public function setId(?string $id): Event
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGuid(): ?string
    {
        return $this->guid;
    }

    /**
     * @param string|null $guid
     * @return Event
     */
    public function setGuid(?string $guid): Event
    {
        $this->guid = $guid;
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
     * @return Event
     */
    public function setName(?string $name): Event
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Event
     */
    public function setDescription(?string $description): Event
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @param string|null $startDate
     * @return Event
     */
    public function setStartDate(?string $startDate): Event
    {
        $this->startDate = $startDate;
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
     * @return Event
     */
    public function setEndDate(?string $endDate): Event
    {
        $this->endDate = $endDate;
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
     * @return Event
     */
    public function setChatStatus(?string $chatStatus): Event
    {
        $this->chatStatus = $chatStatus;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getPermissions(): ?array
    {
        return $this->permissions;
    }

    /**
     * @param array|null $permissions
     * @return Event
     */
    public function setPermissions(?array $permissions): Event
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCalendar(): ?array
    {
        return $this->calendar;
    }

    /**
     * @param array|null $calendar
     * @return Event
     */
    public function setCalendar(?array $calendar): Event
    {
        $this->calendar = $calendar;
        return $this;
    }

}