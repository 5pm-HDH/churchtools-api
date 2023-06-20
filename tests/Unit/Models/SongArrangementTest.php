<?php

namespace CTApi\Test\Unit\Models;

use CTApi\Models\SongArrangement;
use PHPUnit\Framework\TestCase;

class SongArrangementTest extends TestCase
{

    private SongArrangement $EMPTY_ARRANGEMENT;
    private SongArrangement $FULL_ARRANGEMENT;

    protected function setUp(): void
    {
        $this->EMPTY_ARRANGEMENT = new SongArrangement();
        $this->FULL_ARRANGEMENT = SongArrangement::createModelFromData([
            "id" => "9218",
            "name" => "E-Git",
            "files" => [
                ["name" => "chordsheet-1.pdf"],
                ["name" => "chordsheet-1.docx"],
                ["name" => "lyrics.docx"],
                ["name" => "bass-tabs.pdf"]
            ],
            "links" => [
                ["fileUrl" => "https://multitracks.com/path/to/song"],
                ["fileUrl" => "multitracks.com"],
            ]
        ]);

        $this->assertInstanceOf(SongArrangement::class, $this->EMPTY_ARRANGEMENT);
        $this->assertInstanceOf(SongArrangement::class, $this->FULL_ARRANGEMENT);

    }

    public function testGetFirstFile(): void
    {
        $firstFile = $this->EMPTY_ARRANGEMENT->requestFirstFile("test");

        $this->assertNull($firstFile);

        $chordsheet = $this->FULL_ARRANGEMENT->requestFirstFile("chords");
        $this->assertEquals("chordsheet-1.pdf", $chordsheet?->getName());

        $chordsheetInPdfFile = $this->FULL_ARRANGEMENT->requestFirstFile("chords", "pdf");
        $this->assertEquals("chordsheet-1.pdf", $chordsheetInPdfFile?->getName());

        $chordsheetInWordFile = $this->FULL_ARRANGEMENT->requestFirstFile("chords", "docx");
        $this->assertEquals("chordsheet-1.docx", $chordsheetInWordFile?->getName());

        $fullName = $this->FULL_ARRANGEMENT->requestFirstFile("chordsheet-1.pdf");
        $this->assertEquals("chordsheet-1.pdf", $fullName?->getName());

        $fullNameWithFileExtension = $this->FULL_ARRANGEMENT->requestFirstFile("chordsheet-1.pdf", "pdf");
        $this->assertEquals("chordsheet-1.pdf", $fullNameWithFileExtension?->getName());

        $lyricsAsOnSongFile = $this->FULL_ARRANGEMENT->requestFirstFile("lyrics", "onsong");
        $this->assertNull($lyricsAsOnSongFile);

        $caseMismatch = $this->FULL_ARRANGEMENT->requestFirstFile("CHORDS", "pdf");
        $this->assertEquals("chordsheet-1.pdf", $caseMismatch?->getName());
    }

    public function testGetFirstLink(): void
    {
        $firstLink = $this->EMPTY_ARRANGEMENT->requestFirstLink("test");

        $this->assertNull($firstLink);

        $multiTracksLink = $this->FULL_ARRANGEMENT->requestFirstLink("multitracks.com");
        $this->assertEquals("https://multitracks.com/path/to/song", $multiTracksLink?->getFileUrl());
    }

}