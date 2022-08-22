<?php


namespace CTApi\Requests;

use CTApi\Models\Person;

class PersonRequest
{
    public static function whoami(): Person
    {
        return (new PersonRequestBuilder())->whoami();
    }

    public static function all(): array
    {
        return (new PersonRequestBuilder())->all();
    }

    public static function where(string $key, $value): PersonRequestBuilder
    {
        return (new PersonRequestBuilder())->where($key, $value);
    }

    public static function orderBy(string $key, $orderAscending = true): PersonRequestBuilder
    {
        return (new PersonRequestBuilder())->orderBy($key, $orderAscending);
    }

    public static function findOrFail(int $id): Person
    {
        return (new PersonRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?Person
    {
        return (new PersonRequestBuilder())->find($id);
    }

    /**
     * Update the person's data on churchtools.
     *
     * @param array $attributesToUpdate
     *        Pass the attributes that should be updated as array. If nothing or
     *        an empty array is passed, all data of the person will be sent to the API.
     *        If an array is passed that looks like this:
     *        <code>['firstName', 'lastName', 'nickname']</code>
     *        only those attributes will be sent to the API.
     */
    public static function update(Person $person, array $attributesToUpdate = []): void
    {
        (new PersonRequestBuilder())->update($person, $attributesToUpdate);
    }

    /**
     * Delete the person on churchtools.
     */
    public static function delete(Person $person): void
    {
        (new PersonRequestBuilder())->delete($person->getId());
    }
}