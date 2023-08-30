<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Models\Common\File\File;
use CTApi\Models\Events\Song\Song;
use CTApi\Models\Events\Song\SongArrangement;
use CTApi\Models\Events\Song\SongRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;


class SongRequestTest extends TestCaseAuthenticated
{
    private int $SONG_ID = 0;
    private string $SONG_NAME = "";
    private int $SONG_ARRANGEMENT_ID = 0;
    private string $SONG_ARRANGEMENT_NAME = "";

    protected function setUp(): void
    {
        $testCase = IntegrationTestData::getTestCase("get_song");

        $this->SONG_ID = $testCase->getFilterAsInt("song_id");
        $this->SONG_NAME = $testCase->getFilter("song_name");
        $this->SONG_ARRANGEMENT_ID = $testCase->getFilterAsInt("arrangement_id");
        $this->SONG_ARRANGEMENT_NAME = $testCase->getFilter("arrangement_name");

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
        $this->assertNotNull($oneSong);
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
        $this->assertEquals($song->getName(), $this->SONG_NAME);
        $this->selectTestArrangementInSong($song);
        return $song;
    }

    private function selectTestArrangementInSong(Song $song): SongArrangement
    {
        foreach ($song->getArrangements() as $arrangement) {
            if ($this->SONG_ARRANGEMENT_ID == $arrangement->getId()) {
                $this->assertEquals($this->SONG_ARRANGEMENT_NAME, $arrangement->getName());
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