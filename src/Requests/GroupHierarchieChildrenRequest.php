<?php


namespace CTApi\Requests;


class GroupHierarchieChildrenRequest extends GroupHierarchieAbstractRequest
{
    public function get(): array
    {
        $hierarchie = $this->requestHierarchieObject();
        $children = [];
        foreach ($hierarchie as $hierarchieItem) {
            if (array_key_exists("children", $hierarchieItem)) {
                foreach ($hierarchieItem["children"] as $childId) {
                    $group = GroupRequest::find($childId);
                    if ($group != null) {
                        $children[] = $group;
                    }
                }
            }
        }
        return $children;
    }
}