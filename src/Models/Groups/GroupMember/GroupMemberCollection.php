<?php

namespace CTApi\Models\Groups\GroupMember;

use CTApi\Models\AbstractCollection;
use CTApi\Models\Groups\Person\PersonCollection;
use CTApi\Models\Groups\Person\PersonRequest;

class GroupMemberCollection extends AbstractCollection
{

    protected function getClassType(): string
    {
        return GroupMember::class;
    }

    public function requestPersons(): PersonCollection
    {
        $ids = array_map(function(GroupMember $groupMember){
            return $groupMember->getPersonId();
        }, $this);

        return PersonRequest::where('ids', $ids)->get();
    }

}