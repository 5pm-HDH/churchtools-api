<?php

namespace CTApi\Models\Common\Note;

use CTApi\Models\AbstractModel;
use CTApi\Models\Common\Domain\Meta;
use CTApi\Traits\Model\FillWithData;
use CTApi\Traits\Model\MetaAttribute;

class Note extends AbstractModel
{
    use FillWithData;
    use MetaAttribute;

    protected ?string $domainId = null;
    protected ?string $domainType = null;
    protected ?string $text = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
        }
    }

    public function setId(?string $id): Note
    {
        $this->id = $id;
        return $this;
    }

    public function getDomainId(): ?string
    {
        return $this->domainId;
    }

    public function setDomainId(?string $domainId): Note
    {
        $this->domainId = $domainId;
        return $this;
    }

    public function getDomainType(): ?string
    {
        return $this->domainType;
    }

    public function setDomainType(?string $domainType): Note
    {
        $this->domainType = $domainType;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): Note
    {
        $this->text = $text;
        return $this;
    }
}
