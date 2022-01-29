<?php


namespace CTApi\Requests;


class GroupHierarchieParentsRequest extends GroupHierarchieAbstractRequest
{
    public function get(): array
    {
        $hierarchie = $this->requestHierarchieObject();
        $parents = [];
        foreach ($hierarchie as $hierarchieItem) {
            if (array_key_exists("parents", $hierarchieItem)) {
                foreach ($hierarchieItem["parents"] as $parentId) {
                    $group = GroupRequest::find($parentId);
                    if ($group != null) {
                        $parents[] = $group;
                    }
                }
            }
        }
        return $parents;
    }
}