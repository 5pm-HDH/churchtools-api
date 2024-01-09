<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Events\Song\CcliRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class CcliRequestTest extends TestCaseHttpMocked
{
    public function testRetrieveLyrics()
    {
        $ccliNumber = 1878670;

        $songLyrics = CcliRequest::forSong($ccliNumber)->retrieveLyrics();

        $this->assertNotNull($songLyrics);
        $this->assertEquals("1878670", $songLyrics->getCclid());
        $authorList = implode("/", $songLyrics->getAuthors());
        $this->assertEquals("Andres Figueroa/Hank Bentley/Mariah McManus/Mia Fieldes", $authorList);
        $copyright = implode("/", $songLyrics->getCopyrights());
        $this->assertEquals("2016 All Essential Music/Be Essential Songs/Bentley Street Songs/Mosaic LA Music/Mosaic MSC Music/Tempo Music Investments", $copyright);
        $this->assertEquals("For us solely with the SongSelect Terms of us.  All rights reserved. www.ccli.com", $songLyrics->getDisclaimer());
        $this->assertEquals("4c0ad6fe-402c-e611-9427-0050568927dd", $songLyrics->getSongID());
        $this->assertEquals("7065049", $songLyrics->getSongNumber());
        $this->assertEquals("Tremble", $songLyrics->getTitle());

        // Show second lyrics part:
        $this->assertEquals("Still call the sea to still\nThe rage in me to still\nEvery wave at Your name", $songLyrics->getLyricParts()[1]["lyrics"]);
        $this->assertEquals("Verse", $songLyrics->getLyricParts()[1]["partType"]);
        $this->assertEquals("2", $songLyrics->getLyricParts()[1]["partTypeNumber"]);
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
