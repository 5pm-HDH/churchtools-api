<?php

namespace CTApi\Models\Events\SongStatistic;

use CTApi\Traits\Model\FillWithData;

class SongStatistic
{
    use FillWithData;

    protected ?string $arrangementId;
    protected array $dates = [];

    public static function createModelFromAjaxData(string $songId, array $dates): SongStatistic
    {
        $statistics = new SongStatistic();
        return $statistics->setArrangementId($songId)
            ->setDates($dates);
    }

    public function getDates(): array
    {
        return $this->dates;
    }

    public function getCount(): int
    {
        return sizeof($this->getDates());
    }

    public function getDatesForCalendars(array $calendarIds): array
    {
        return array_values(array_filter($this->dates, function ($element) use ($calendarIds) {
            return in_array($element["calendar_id"], $calendarIds);
        }));
    }

    public function getCountForCalendars(array $calendarIds): int
    {
        return sizeof($this->getDatesForCalendars($calendarIds));
    }

    public function toData(): array
    {
        $data = $this->convertPropertiesToData();
        return array_merge(
            $data,
            ['count' => $this->getCount()]
        );
    }

    /**
     * @return string|null
     */
    public function getArrangementId(): ?string
    {
        return $this->arrangementId;
    }

    /**
     * @param string|null $arrangementId
     * @return SongStatistic
     */
    public function setArrangementId(?string $arrangementId): SongStatistic
    {
        $this->arrangementId = $arrangementId;
        return $this;
    }

    /**
     * @param array $dates
     * @return SongStatistic
     */
    public function setDates(array $dates): SongStatistic
    {
        $this->dates = array_map(function ($element) {
            return [
                'date' => $element['date'] ?? null,
                'calendar_id' => $element['category_id'] ?? null
            ];
        }, $dates);
        return $this;
    }
}
