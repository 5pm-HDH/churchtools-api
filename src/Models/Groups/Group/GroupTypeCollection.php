<?php

namespace CTApi\Models\Groups\Group;

use CTApi\Models\AbstractCollection;

class GroupTypeCollection extends AbstractCollection
{
    protected function getClassType(): string
    {
        return GroupType::class;
    }
}