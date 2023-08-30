<?php


namespace CTApi\Models\Events\Song;


use CTApi\Traits\Request\AjaxApi;
use CTApi\Utils\CTResponseUtil;

class SongArrangementUpdateRequestBuilder
{
    use AjaxApi;

    public function update(SongArrangement $songArrangement): void
    {
        $updateAttributes = $songArrangement->getModifiableAttributes();
        $allData = $songArrangement->extractData();
        $updateAttributes = array_intersect_key($allData, array_flip($updateAttributes));

        $this->setAjaxKeyTranslation("name", "bezeichnung");
        $this->setAjaxKeyTranslation("keyOfArrangement", "tonality");
        $this->setAjaxKeyTranslation("duration", "length_sec");
        $updateAttributes["length_min"] = 0;
        $updateAttributes["id"] = $songArrangement->getIdOrFail();

        $response = $this->requestAjax("churchservice/ajax", "editArrangement", $updateAttributes);

        $data = CTResponseUtil::jsonToArray($response);
    }
}