<?php


namespace CTApi\Requests;


use CTApi\Exceptions\CTRequestException;
use CTApi\Models\SongStatistic;
use CTApi\Requests\Traits\AjaxApi;
use CTApi\Utils\CTResponseUtil;

class SongStatisticRequestBuilder
{
    use AjaxApi;

    private array $data = [];

    /**
     * SongStatisticRequestBuilder constructor.
     * @param bool $isLazy determine if builder requests statistic-data for every request new
     */
    public function __construct(
        private bool $isLazy = true
    )
    {
    }

    private function getStatisticData(): array
    {
        if($this->isLazy && !empty($this->data)){
            return $this->data;
        }else{
            $response = $this->requestAjax("churchservice/ajax", "getSongStatistic", []);
            $this->data = CTResponseUtil::dataAsArray($response);
            return $this->data;
        }
    }

    public function findOrFail(string $songId)
    {
        $model = $this->find($songId);
        if ($model != null) {
            return $model;
        } else {
            throw CTRequestException::ofModelNotFound(SongStatistic::class);
        }
    }

    public function find(string $songId): ?SongStatistic
    {
        $data = $this->getStatisticData();
        if(array_key_exists($songId, $data)){
            return SongStatistic::createModelFromAjaxData($songId, $data[$songId]);
        }
        return null;
    }

    public function all(): array
    {
        $data = $this->getStatisticData();
        $modelArray = [];
        foreach($data as $songId => $dates)
        {
            $modelArray[] = SongStatistic::createModelFromAjaxData($songId, $dates);
        }
        return $modelArray;
    }
}