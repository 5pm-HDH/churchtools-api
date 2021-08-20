<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\Event;
use CTApi\Models\Group;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class GroupRequestBuilder
{
    use Pagination, WhereCondition, OrderByCondition;

    public function all(): array
    {
        $data = $this->collectDataFromPages('/api/groups', []);
        return Group::createModelsFromArray($data);
    }

    public function findOrFail(int $id): Group
    {
        $group = $this->find($id);
        if($group != null){
            return $group;
        }else{
            throw new CTModelException("Could not retrieve model!");
        }
    }

    public function find(int $id): ?Group
    {
        $groupData = null;
        try{
            $response = CTClient::getClient()->get('/api/groups/'.$id);
            $groupData = CTResponseUtil::dataAsArray($response);
        } catch(GuzzleException $e){
            // ignore
        }

        if(empty($groupData)){
            return null;
        } else {
            return Group::createModelFromData($groupData);
        }
    }

    public function get(): array
    {
        $options = [];
        $this->addWhereConditionsToOption($options);

        $data = $this->collectDataFromPages('/api/groups', $options);

        $this->orderRawData($data);

        return Event::createModelsFromArray($data);
    }
}