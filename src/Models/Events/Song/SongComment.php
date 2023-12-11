<?php

namespace CTApi\Models\Events\Song;

use CTApi\Models\AbstractModel;
use CTApi\Models\Common\Domain\Meta;
use CTApi\Models\Groups\Person\Person;
use CTApi\Traits\Model\FillWithData;

class SongComment extends AbstractModel
{
    use FillWithData;

    private ?string $domainId = null;
    private ?string $domainType = null;
    private ?string $text = null;
    private ?Meta $meta = null;

    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "domain_type":
                $this->domainType = $value;
                break;
            case "domain_id":
                $this->domainId = $value;
                break;
            case "modified_date":
                if ($this->meta === null) {
                    $this->meta = new Meta();
                }
                $this->meta->setModifiedDate($value);
                break;
            case "modified_pid":
                if ($this->meta === null) {
                    $this->meta = new Meta();
                }
                $this->meta->setModifiedPerson(Person::createModelFromData(["id" => $value]));
                break;
            default:
                $this->fillDefault($key, $value);
        }
    }

    public function getDomainId(): ?string
    {
        return $this->domainId;
    }

    public function setDomainId(?string $domainId): SongComment
    {
        $this->domainId = $domainId;
        return $this;
    }

    public function getDomainType(): ?string
    {
        return $this->domainType;
    }

    public function setDomainType(?string $domainType): SongComment
    {
        $this->domainType = $domainType;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): SongComment
    {
        $this->text = $text;
        return $this;
    }

    public function setId(?string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getMeta(): ?Meta
    {
        return $this->meta;
    }

    public function setMeta(?Meta $meta): SongComment
    {
        $this->meta = $meta;
        return $this;
    }
}