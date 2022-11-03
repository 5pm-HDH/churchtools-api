<?php


namespace Tests\Unit\Docs;


use CTApi\Requests\CcliRequest;
use Tests\Unit\TestCaseHttpMocked;

class CcliRequestTest extends TestCaseHttpMocked
{

    public function testRetrieveLyrics()
    {
        $ccliNumber = 1878670;

        $lyricsData = CcliRequest::forSong($ccliNumber)->retrieveLyrics();

        $this->assertEquals("1878670", $lyricsData["CCLID"]);
        $authorList = implode("/", $lyricsData["Authors"]);
        $this->assertEquals("Andres Figueroa/Hank Bentley/Mariah McManus/Mia Fieldes", $authorList);
        $copyright = implode("/", $lyricsData["Copyright"]);
        $this->assertEquals("2016 All Essential Music (Admin. by Essential Music Publishing LLC)/Be Essential Songs (Admin. by Essential Music Publishing LLC)/Bentley Street Songs (Admin. by Essential Music Publishing LLC)/Mosaic LA Music (Admin. by Essential Music Publishing LLC)/Mosaic MSC Music (Admin. by Essential Music Publishing LLC)/Tempo Music Investments (Admin. by Essential Music Publishing LLC)", $copyright);
        $this->assertEquals("For ue solely with the SongSelect Terms of Ue.  All rights reserved. www.ccli.com", $lyricsData["Disclaimer"]);
        $this->assertEquals("4c0ad6fe-402c-e611-9427-0050568927dd", $lyricsData["SongID"]);
        $this->assertEquals("7065049", $lyricsData["SongNumber"]);
        $this->assertEquals("Tremble", $lyricsData["Title"]);

        // Show second lyrics part:
        $this->assertEquals("Still call the sea to still | The rage in me to still | Every wave at Your name", $lyricsData["LyricParts"][1]["Lyrics"]);
        $this->assertEquals("Verse", $lyricsData["LyricParts"][1]["PartType"]);
        $this->assertEquals("2", $lyricsData["LyricParts"][1]["PartTypeNumber"]);
    }

    public function testRetrieveChordsheet()
    {
        $ccliNumber = 1878670;
        $songArrangementId = 2912;
        $fileNameOfChordsheet = "Tremble Chordsheet";
        $chordsheetKey = "C";

        $chordsheetFile = CcliRequest::forSong($ccliNumber)->retrieveChordsheet($songArrangementId, $fileNameOfChordsheet, $chordsheetKey);

        $this->assertEquals("77fd99.pdf", $chordsheetFile?->getFilename());
        $this->assertEquals("110", $chordsheetFile?->getId());
        $this->assertEquals("Tremble Chordsheet - C.pdf", $chordsheetFile?->getName());
        $this->assertEquals("https://example.church.tools//?q=public/filedownload&id=110&filename=77fd99.pdf", $chordsheetFile?->getFileUrl());
    }

}