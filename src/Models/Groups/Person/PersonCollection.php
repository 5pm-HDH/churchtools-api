<?php

namespace CTApi\Models\Groups\Person;

use CTApi\Models\AbstractCollection;

class PersonCollection extends AbstractCollection
{
    protected function getClassType(): string
    {
        return Person::class;
    }
}