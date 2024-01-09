<?php

namespace CTApi\Traits\Model;

use CTApi\Models\Common\Domain\Meta;

trait MetaAttribute
{
    protected ?Meta $meta = null;

    /**
     * @return Meta|null
     */
    public function getMeta(): ?Meta
    {
        return $this->meta;
    }

    /**
     * @param Meta|null $meta
     * @return self
     */
    public function setMeta(?Meta $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

}
