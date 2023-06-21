<?php


namespace CTApi\Models\Events\Song;


use CTApi\Traits\Request\AjaxApi;
use CTApi\Utils\CTResponseUtil;

class SongUpdateRequestBuilder
{
    use AjaxApi;

    public function update(Song $song): void
    {
        $updateAttributes = $song->getModifiableAttributes();
        $allData = $song->extractData();
        $updateAttributes = array_intersect_key($allData, array_flip($updateAttributes));

        $this->setAjaxKeyTranslation("name", "bezeichnung");
        $this->setAjaxKeyTranslation("category_id", "songcategory_id");
        $this->setAjaxKeyTranslation("shouldPractice", "practice_yn");
        $updateAttributes["id"] = $song->getIdOrFail();

        $response = $this->requestAjax("churchservice/ajax", "editSong", $updateAttributes);
        $data = CTResponseUtil::jsonToArray($response);
    }
}