<?php


use CTApi\Models\Song;
use CTApi\Requests\SongRequest;

class SongRequestTest extends TestCaseAuthenticated
{
    protected function setUp(): void
    {
        if (!TestData::getValue("SONG_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }
    }

    public function testGetAllSongs()
    {
        $allSongs = SongRequest::all();
        $this->assertNotEmpty($allSongs);

        $this->assertInstanceOf(Song::class, $allSongs[0]);
    }

    public function testGetOneSong()
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


    public function testWhereSongs()
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

    public function testOrderBy()
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

}