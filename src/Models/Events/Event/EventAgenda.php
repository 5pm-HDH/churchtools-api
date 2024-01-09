<?php

namespace CTApi\Models\Events\Event;

use CTApi\CTLog;
use CTApi\Models\AbstractModel;
use CTApi\Models\Common\Domain\Meta;
use CTApi\Models\Events\Song\Song;
use CTApi\Models\Events\Song\SongArrangementRequestBuilder;
use CTApi\Models\Events\Song\SongRequest;
use CTApi\Models\Events\Song\SongRequestBuilder;
use CTApi\Traits\Model\FillWithData;
use CTApi\Traits\Model\MetaAttribute;

class EventAgenda extends AbstractModel
{
    use FillWithData;
    use MetaAttribute;

    protected ?string $name = null;
    protected ?string $series = null;
    protected ?bool $isFinal = null;
    protected ?string $eventStartPosition = null;
    protected ?string $calendarId = null;
    protected ?string $total = null;
    protected array $items = [];


    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "items":
                $this->setItems(EventAgendaItem::createModelsFromArray($data));
                break;
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    public function getSongs(): array
    {
        CTLog::getLog()->info('EventAgenda: Collect all songs from agenda.');
        $songs = array_map(function ($agendaItem) {
            return $agendaItem->getSong();
        }, $this->getItems());
        return array_filter($songs, function ($song) {
            return !is_null($song);
        });
    }

    /**
     * Attention: This method will lose the information, which arrangement is selected in the EventAgenda.
     * @return SongRequestBuilder
     */
    public function requestSongs(): SongRequestBuilder
    {
        CTLog::getLog()->info("EventAgenda: Request songs from agenda.");
        $songs = $this->getSongs();
        $songIds = array_map(function ($song) {
            return $song->getId();
        }, $songs);

        return SongRequest::where('ids', $songIds);
    }

    /**
     * Returns all arrangements of the event.
     * Attention: This method will lose the song information that the arrangements belong to.
     *
     * @return SongArrangementRequestBuilder
     */
    public function requestArrangements(): SongArrangementRequestBuilder
    {
        $arrangements = array_map(function (Song $song) {
            return $song->requestSelectedArrangement();
        }, $this->getSongs());

        return new SongArrangementRequestBuilder($arrangements);
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
     * @return bool|null
     */
    public function getIsFinal(): ?bool
    {
        return $this->isFinal;
    }

    /**
     * @param bool|null $isFinal
     * @return EventAgenda
     */
    public function setIsFinal(?bool $isFinal): EventAgenda
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
