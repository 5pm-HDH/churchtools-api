<?php

namespace CTApi\Models;

use CTApi\Exceptions\CTModelException;

/**
 * Class AbstractModel
 * @package CTApi\Models
 */
abstract class AbstractModel
{
    protected ?string $id = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Fluent setter have to be implemented by child-class. Returns instance of model.
     * @param string|null $id
     * @return mixed
     */
    abstract public function setId(?string $id);

    /**
     * Throws exception if id is null.
     * @return string
     */
    public function getIdOrFail(): string
    {
        if (is_null($this->id)) {
            throw new CTModelException("Id of " . get_class($this) . " is null.");
        }
        return $this->id;
    }

    /**
     * Throws exception if id cannot be casted to int.
     * @return int
     */
    public function getIdAsInteger(): int
    {
        $id = $this->getIdOrFail();

        $castedInteger = intval($id);
        $backCastedInteger = strval($castedInteger);
        if ($backCastedInteger == $id) {
            return $castedInteger;
        } else {
            throw new CTModelException("Could not cast id (" . $id . ") to integer in " . get_class($this) . ".");
        }
    }
}
