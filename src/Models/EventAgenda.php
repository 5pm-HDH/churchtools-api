<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class EventAgenda
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $name = null;
    protected ?string $series = null;
    protected ?string $isFinal = null;
    protected ?string $eventStartPosition = null;
    protected ?string $calendarId = null;
    protected ?string $total = null;
    protected array $meta = [];
    protected array $items = [];


    protected function fillArrayType(string $key, array $data)
    {
        switch ($key) {
            case "items":
                $this->setItems(EventAgendaItem::createModelsFromArray($data));
                break;
            default:
                $this->{$key} = $data;
        }
    }

    public function getSongs(): array
    {
        $songs = array_map(function ($agendaItem) {
            return $agendaItem->getSong();
        }, $this->getItems());
        return array_filter($songs, function ($song) {
            return !is_null($song);
        });
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
     * @return EventAgenda
     */
    public function setId(?string $id): EventAgenda
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
     * @return EventAgenda
     */
    public function setName(?string $name): EventAgenda
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSeries(): ?string
    {
        return $this->series;
    }

    /**
     * @param string|null $series
     * @return EventAgenda
     */
    public function setSeries(?string $series): EventAgenda
    {
        $this->series = $series;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsFinal(): ?string
    {
        return $this->isFinal;
    }

    /**
     * @param string|null $isFinal
     * @return EventAgenda
     */
    public function setIsFinal(?string $isFinal): EventAgenda
    {
        $this->isFinal = $isFinal;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEventStartPosition(): ?string
    {
        return $this->eventStartPosition;
    }

    /**
     * @param string|null $eventStartPosition
     * @return EventAgenda
     */
    public function setEventStartPosition(?string $eventStartPosition): EventAgenda
    {
        $this->eventStartPosition = $eventStartPosition;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCalendarId(): ?string
    {
        return $this->calendarId;
    }

    /**
     * @param string|null $calendarId
     * @return EventAgenda
     */
    public function setCalendarId(?string $calendarId): EventAgenda
    {
        $this->calendarId = $calendarId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotal(): ?string
    {
        return $this->total;
    }

    /**
     * @param string|null $total
     * @return EventAgenda
     */
    public function setTotal(?string $total): EventAgenda
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @param array $meta
     * @return EventAgenda
     */
    public function setMeta(array $meta): EventAgenda
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return EventAgenda
     */
    public function setItems(array $items): EventAgenda
    {
        $this->items = $items;
        return $this;
    }
}