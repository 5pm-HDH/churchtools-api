<?php

namespace Tests\Integration\Requests;

use CTApi\Models\File;
use CTApi\Models\Song;
use CTApi\Models\SongArrangement;
use CTApi\Requests\SongRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class SongRequestTest extends TestCaseAuthenticated
{
    private string $SONG_ID = "";
    private string $SONG_NAME = "";
    private string $SONG_ARRANGEMENT_ID = "";
    private string $SONG_ARRANGEMENT_NAME = "";

    protected function setUp(): void
    {
        if (!TestData::getValue("SONG_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }

        $this->SONG_ID = TestData::getValue("SONG_ID") ?? "";
        $this->SONG_NAME = TestData::getValue("SONG_NAME") ?? "";
        $this->SONG_ARRANGEMENT_ID = TestData::getValue("SONG_ARRANGEMENT_ID") ?? "";
        $this->SONG_ARRANGEMENT_NAME = TestData::getValue("SONG_ARRANGEMENT_NAME") ?? "";

    }

    public function testGetAllSongs(): void
    {
        $allSongs = SongRequest::all();
        $this->assertNotEmpty($allSongs);

        $this->assertInstanceOf(Song::class, $allSongs[0]);
    }

    public function testGetOneSong(): void
    {
        $allSongs = SongRequest::all();
        $this->assertNotEmpty($allSongs);

        $lastSong = end($allSongs);

        //Retrieve from Find
        $oneSong = SongRequest::find($lastSong->getId());
        $this->assertEquals($lastSong->getName(), $oneSong->getName());

        //Retrieve from FindOrFail
        $oneSong = SongRequest::findOrFail($lastSong->getId());
        $this->assertEquals($lastSong->getName(), $oneSong->getName());
    }


    public function testWhereSongs(): void
    {
        //Collect all Categories:
        $allSongs = SongRequest::all();
        $this->assertNotEmpty($allSongs);

        $filterCategory = $allSongs[0]->getCategory();

        $filteredSongs = SongRequest::where('song_category_ids', [$filterCategory->getId()])->get();
        $this->assertNotEmpty($filteredSongs);

        $this->assertTrue(sizeof($allSongs) > sizeof($filteredSongs));

        foreach ($filteredSongs as $song) {
            $songCategory = $song->getCategory();

            $this->assertNotNull($songCategory);
            $this->assertEquals($songCategory->getName(), $filterCategory->getName());
        }
    }

    public function testOrderBy(): void
    {
        $allSongs = SongRequest::all();
        $allSongsName = array_map(function ($song) {
            return $song->getName();
        }, $allSongs);
        sort($allSongsName);

        $this->assertNotEmpty($allSongsName);

        $allSongsSorted = SongRequest::orderBy('name')->get();
        $this->assertNotEmpty($allSongsSorted);

        $this->assertEquals(sizeof($allSongsName), sizeof($allSongsSorted));
        $this->assertEquals(
            $allSongsName[0],
            $allSongsSorted[0]->getName()
        );
        $this->assertEquals(
            end($allSongsName),
            end($allSongsSorted)->getName()
        );
    }

    private function getSong(): Song
    {
        $song = SongRequest::findOrFail($this->SONG_ID);
        $this->assertNotNull($song);
        $this->selectTestArrangementInSong($song);
        return $song;
    }

    private function selectTestArrangementInSong(Song $song): SongArrangement
    {
        foreach ($song->getArrangements() as $arrangement) {
            if ($this->SONG_ARRANGEMENT_ID == $arrangement->getId()) {
                return $arrangement;
            }
        }
        $this->fail("Could not select the test arrangement in the given in song.");
    }

    public function testSongFilesAndLinks(): void
    {
        $song = $this->getSong();
        $arrangement = $this->selectTestArrangementInSong($song);

        $this->assertNotNull($arrangement->getLinks());
        foreach ($arrangement->getLinks() as $link) {
            $this->assertInstanceOf(File::class, $link);
        }

        $this->assertNotNull($arrangement->getFiles());
        foreach ($arrangement->getFiles() as $file) {
            $this->assertInstanceOf(File::class, $file);
        }
    }
}