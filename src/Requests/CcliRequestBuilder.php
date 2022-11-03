<?php


namespace CTApi\Requests;


use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Models\File;
use CTApi\Models\SongArrangement;
use CTApi\Requests\Traits\AjaxApi;
use CTApi\Utils\CTResponseUtil;
use CTApi\Utils\CTUtil;

class CcliRequestBuilder
{
    use AjaxApi;

    public function __construct(
        protected int $ccliNumber
    )
    {
    }

    /**
     * Retrieve Lyrics-Data from Song of given CCLI-Number. This call does not create any file on the song-arrangement.
     * @return array
     */
    public function retrieveLyrics(): array
    {
        $response = $this->requestAjax("churchservice/ajax", "getCCLILyrics", [
            "songNumber" => $this->ccliNumber
        ]);

        $data = CTResponseUtil::jsonToArray($response);

        $jsonDataAsString = CTUtil::arrayPathGet($data, "data.content");
        CTLog::getLog()->debug("Parse CCLI-Lyrics data:", ["jsonDataAsString" => $jsonDataAsString]);

        if(!is_null($jsonDataAsString)){
            try{
                $jsonData = json_decode($jsonDataAsString, true);
                return $jsonData ?? [];
            }catch (\Exception $exception) {
                CTLog::getLog()->debug("Could not parse JSON-String: ", ["jsonDataAsString" => $jsonDataAsString, "exception" => $exception]);
            }
        }

        return $data;
    }

    /**
     * Retrieve and add Chordsheet to song-arrangement
     * @param int $arrangementId Id of song-arrangement
     * @param string $fileName Filename for chordsheet
     * @param string $chordsheetKey Key for chordsheet
     * @return File|null File-Instance or null if error raised
     */
    public function retrieveChordsheet(int $arrangementId, string $fileName, string $chordsheetKey): ?File
    {
        $response = $this->requestAjax("churchservice/ajax", "getCCLIChordsFile", [
            "songNumber" => $this->ccliNumber,
            "tonality" => $chordsheetKey,
            "title" => $fileName,
            "arrangementID" => $arrangementId
        ]);

        $data = CTResponseUtil::jsonToArray($response);

        if(CTUtil::arrayPathGet($data, "status") == "success"){
            $file = (new File())
                ->setId(CTUtil::arrayPathGet($data, "data.id"))
                ->setName(CTUtil::arrayPathGet($data, "data.bezeichnung"))
                ->setFilename(CTUtil::arrayPathGet($data, "data.filename"));

            // Generate file url
            $file->setFileUrl(
                CTConfig::getApiUrl() . "/?q=public/filedownload&id=".$file->getId()."&filename=".$file->getFilename()
            );

            return $file;
        }

        return null;
    }
}