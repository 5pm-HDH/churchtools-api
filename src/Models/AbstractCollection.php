<?php

namespace CTApi\Models;


use ArrayAccess;
use ArrayObject;
use Countable;
use IteratorAggregate;
use Traversable;

abstract class AbstractCollection implements IteratorAggregate, ArrayAccess, Countable
{
    private ArrayObject $arrayObject;

    public function __construct(array $array = [])
    {
        foreach($array as $value){
            $this->validateValue($value);
        }
        $this->arrayObject = new ArrayObject($array);
    }

    protected abstract function getClassType(): string;

    protected abstract function createInstance(array $data): AbstractCollection;

    private function validateValue(mixed $value): void
    {
        $classType = $this->getClassType();
        if(!is_a($value, $classType)){
            $valueType = is_object($value) ? get_class($value) : gettype($value);
            throw new \InvalidArgumentException("Value from type " . $valueType . " is not assignable to Collection from type " . get_class($this));
        }
    }

    /**
     * Alias for append.
     * @param object $value
     * @return void
     */
    public function push(object $value): void
    {
        $this->append($value);
    }
    public function append(object $value): void
    {
        $this->validateValue($value);
        $this->arrayObject[] = $value;
    }

    public function first(): ?object
    {
        $iterator = $this->arrayObject->getIterator();
        return $iterator->current();
    }

    public function filter(callable $callback, int $mode = 0): self
    {
        $filtered = array_filter((array) $this->arrayObject, $callback, $mode);
        return $this->createInstance($filtered);
    }

    public function map(callable $callback): self
    {
        $filtered = array_map($callback, (array) $this->arrayObject);
        return $this->createInstance($filtered);
    }

    public function count(): int
    {
        return $this->arrayObject->count();
    }

    /**
     * Sort the entries by value
     * @param int $flags
     * @return bool
     */
    public function asort(int $flags = SORT_REGULAR): bool
    {
        return $this->arrayObject->asort($flags);
    }

    /**
     * Sort the entries by key
     * @param int $flags
     * @return bool
     */
    public function ksort(int $flags = SORT_REGULAR): bool
    {
        return $this->arrayObject->ksort($flags);
    }

    /**
     * Sort the entries with a user-defined comparison function and maintain key association
     * @param callable $callback
     * @return bool
     */
    public function uasort(callable $callback): bool
    {
        return $this->arrayObject->uasort($callback);
    }

    public function getIterator(): Traversable
    {
        return $this->arrayObject->getIterator();
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->arrayObject->offsetExists($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->arrayObject->offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->validateValue($value);
        $this->arrayObject->offsetSet($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->arrayObject->offsetUnset($offset);
        $this->filterNullableEntries();
    }

    private function filterNullableEntries(): void
    {
        $withoutNullable = array_filter($this->arrayObject->getArrayCopy(), function($element){
           return isset($element);
        });
        $this->arrayObject->exchangeArray(array_values($withoutNullable));
    }
}