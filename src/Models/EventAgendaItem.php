<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;

class EventAgendaItem
{
    use FillWithData, MetaAttribute;

    protected ?string $id = null;
    protected ?string $position = null;
    protected ?string $title = null;
    protected ?string $type = null;
    protected ?string $note = null;
    protected ?string $duration = null;
    protected ?string $start = null;
    protected ?string $isBeforeEvent = null;
    protected ?array $responsible = null;
    protected ?array $serviceGroupNotes = null;
    protected ?Song $song = null;


    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "song":
                $this->setSong(Song::createModelFromData($data));
                break;
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
            default:
                $this->{$key} = $data;
        }
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
     * @return EventAgendaItem
     */
    public function setId(?string $id): EventAgendaItem
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string|null $position
     * @return EventAgendaItem
     */
    public function setPosition(?string $position): EventAgendaItem
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return EventAgendaItem
     */
    public function setTitle(?string $title): EventAgendaItem
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return EventAgendaItem
     */
    public function setType(?string $type): EventAgendaItem
    {
        $this->type = $type;
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
     * @return EventAgendaItem
     */
    public function setNote(?string $note): EventAgendaItem
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     * @return EventAgendaItem
     */
    public function setDuration(?string $duration): EventAgendaItem
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStart(): ?string
    {
        return $this->start;
    }

    /**
     * @param string|null $start
     * @return EventAgendaItem
     */
    public function setStart(?string $start): EventAgendaItem
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsBeforeEvent(): ?string
    {
        return $this->isBeforeEvent;
    }

    /**
     * @param string|null $isBeforeEvent
     * @return EventAgendaItem
     */
    public function setIsBeforeEvent(?string $isBeforeEvent): EventAgendaItem
    {
        $this->isBeforeEvent = $isBeforeEvent;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getResponsible(): ?array
    {
        return $this->responsible;
    }

    /**
     * @param array|null $responsible
     * @return EventAgendaItem
     */
    public function setResponsible(?array $responsible): EventAgendaItem
    {
        $this->responsible = $responsible;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getServiceGroupNotes(): ?array
    {
        return $this->serviceGroupNotes;
    }

    /**
     * @param array|null $serviceGroupNotes
     * @return EventAgendaItem
     */
    public function setServiceGroupNotes(?array $serviceGroupNotes): EventAgendaItem
    {
        $this->serviceGroupNotes = $serviceGroupNotes;
        return $this;
    }

    /**
     * @return Song|null
     */
    public function getSong(): ?Song
    {
        return $this->song;
    }

    /**
     * @param Song|null $song
     * @return EventAgendaItem
     */
    public function setSong(?Song $song): EventAgendaItem
    {
        $this->song = $song;
        return $this;
    }
}