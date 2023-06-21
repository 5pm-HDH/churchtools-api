<?php


namespace CTApi\Models\Groups\Group;


use CTApi\Exceptions\CTPermissionException;

class GroupHierarchieChildrenRequest extends GroupHierarchieAbstractRequest
{
    public function get(): array
    {
        $hierarchie = $this->requestHierarchieObject();
        $children = [];
        foreach ($hierarchie as $hierarchieItem) {
            if (array_key_exists("children", $hierarchieItem)) {
                foreach ($hierarchieItem["children"] as $childId) {
                    $group = null;
                    try{
                        $group = GroupRequest::find($childId);
                    }catch (CTPermissionException $exception){
                        // user has no permission to access group
                    }
                    if ($group != null) {
                        $children[] = $group;
                    }
                }
            }
        }
        return $children;
    }
}