<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;
use CTApi\Requests\AppointmentRequestBuilder;

class Calendar extends AbstractModel
{
    use FillWithData, MetaAttribute;

    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $sortKey = null;
    protected ?string $color = null;
    protected ?bool $isPublic = null;
    protected ?bool $isPrivate = null;
    protected ?string $randomUrl = null;
    protected ?string $iCalSourceUrl = null;
    protected ?string $campusId = null;
    protected ?string $eventTemplateId = null;
    protected ?Meta $meta = null;

    protected function fillArrayType(string $key, array $data): void
    {
        if ($key == "meta") {
            $this->meta = Meta::createModelFromData($data);
        } else {
            $this->fillDefault($key, $data);
        }
    }

    public function requestAppointments(): ?AppointmentRequestBuilder
    {
        if(!is_null($this->getId())){
            return new AppointmentRequestBuilder([$this->getId()]);
        }else{
            return null;
        }
    }

    /**
     * @param string|null $id
     * @return Calendar
     */
    public function setId(?string $id): Calendar
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
     * @return Calendar
     */
    public function setName(?string $name): Calendar
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNameTranslated(): ?string
    {
        return $this->nameTranslated;
    }

    /**
     * @param string|null $nameTranslated
     * @return Calendar
     */
    public function setNameTranslated(?string $nameTranslated): Calendar
    {
        $this->nameTranslated = $nameTranslated;
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
     * @return Calendar
     */
    public function setSortKey(?string $sortKey): Calendar
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     * @return Calendar
     */
    public function setColor(?string $color): Calendar
    {
        $this->color = $color;
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
     * @return Calendar
     */
    public function setIsPublic(?bool $isPublic): Calendar
    {
        $this->isPublic = $isPublic;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    /**
     * @param bool|null $isPrivate
     * @return Calendar
     */
    public function setIsPrivate(?bool $isPrivate): Calendar
    {
        $this->isPrivate = $isPrivate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRandomUrl(): ?string
    {
        return $this->randomUrl;
    }

    /**
     * @param string|null $randomUrl
     * @return Calendar
     */
    public function setRandomUrl(?string $randomUrl): Calendar
    {
        $this->randomUrl = $randomUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getICalSourceUrl(): ?string
    {
        return $this->iCalSourceUrl;
    }

    /**
     * @param string|null $iCalSourceUrl
     * @return Calendar
     */
    public function setICalSourceUrl(?string $iCalSourceUrl): Calendar
    {
        $this->iCalSourceUrl = $iCalSourceUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCampusId(): ?string
    {
        return $this->campusId;
    }

    /**
     * @param string|null $campusId
     * @return Calendar
     */
    public function setCampusId(?string $campusId): Calendar
    {
        $this->campusId = $campusId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEventTemplateId(): ?string
    {
        return $this->eventTemplateId;
    }

    /**
     * @param string|null $eventTemplateId
     * @return Calendar
     */
    public function setEventTemplateId(?string $eventTemplateId): Calendar
    {
        $this->eventTemplateId = $eventTemplateId;
        return $this;
    }

    /**
     * @return Meta|null
     */
    public function getMeta(): ?Meta
    {
        return $this->meta;
    }

    /**
     * @param Meta|null $meta
     * @return Calendar
     */
    public function setMeta(?Meta $meta): Calendar
    {
        $this->meta = $meta;
        return $this;
    }
}