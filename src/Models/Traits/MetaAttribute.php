<?php


namespace CTApi\Models\Traits;


use CTApi\Models\Meta;

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
     * @return MetaAttribute
     */
    public function setMeta(?Meta $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

}