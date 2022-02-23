<?php


namespace Tests\Unit\Docs;


use CTApi\Models\File;
use CTApi\Requests\SongRequest;
use Tests\Unit\TestCaseHttpMocked;


class SongRequestTest extends TestCaseHttpMocked
{
    public function testExampleCode()
    {
        $allSongs = SongRequest::all();
        $practiceSong = SongRequest::where('practice', true)->orderBy('name')->get();

        $songs = SongRequest::where('key_of_arrangement', 'G')->get();
        $songs = SongRequest::where('song_category_ids', [29, 30])->get();

        $song = SongRequest::findOrFail(21);

        /**
         * Song-Model
         */
        $this->assertEquals("21", $song->getId());
        $this->assertEquals("We welcome you", $song->getName());
        $this->assertEquals("1", $song->getShouldPractice());
        $this->assertEquals("Michael W. Smith", $song->getAuthor());
        $this->assertEquals("C9219", $song->getCcli());
        $this->assertEquals("Worship Music", $song->getCopyright());
        $this->assertEquals("Nothing to note.", $song->getNote());

        // only if arrangement is select (e.q. agenda)
        $this->assertEquals("", $song->getArrangement());
        $this->assertEquals("", $song->getKey());
        $this->assertEquals("", $song->getBpm());
        $this->assertEquals("", $song->getIsDefault());

        $selectedArrangement = $song->requestSelectedArrangement();

        $firstArrangement = $song->getArrangements()[0];

        /**
         * Arrangement-Model
         */
        $this->assertEquals("221", $selectedArrangement?->getId());
        $this->assertEquals("In A-Dur", $selectedArrangement?->getName());
        $this->assertEquals("1", $selectedArrangement?->getIsDefault());
        $this->assertEquals("A", $selectedArrangement?->getKeyOfArrangement());
        $this->assertEquals("120", $selectedArrangement?->getBpm());
        $this->assertEquals("4/4", $selectedArrangement?->getBeat());
        $this->assertEquals("210", $selectedArrangement?->getDuration());
        $this->assertEquals("-", $selectedArrangement?->getNote());
        $selectedArrangement?->getLinks();
        $selectedArrangement?->getFiles();


        /**
         *  File-Model
         */
        foreach (($selectedArrangement?->getFiles() ?? []) as $file) {
            $this->assertEquals("", $file->getDomainType());
            $this->assertEquals("", $file->getDomainId());
            $this->assertEquals("chords-a.pdf", $file->getName());
            $this->assertEquals("chords-a.pdf", $file->getFilename());
            $this->assertEquals("https://some-churchtools-api-url.com/", $file->getFileUrl());
        }

        $chordsheet = $selectedArrangement?->requestFirstFile('chord', 'pdf');
        $youtubeLink = $selectedArrangement?->requestFirstLink('youtube.com');

        // Download File:
        //$chordsheet->downloadToClient(); //downloads to client
        //$chordsheet->downloadToPath(__DIR__.'/files');

        $customFile = File::createModelFromData([
            'fileUrl' => 'https://multitracks.com/path/to/song?id=2912'
        ]);

        $this->assertEquals("https://multitracks.com/path/to/song", $customFile->getFileUrlBaseUrl());
        $this->assertEquals(["id" => "2912"], $customFile->getFileUrlQueryParameters());
        $this->assertEquals("https://multitracks.com/path/to/song?id=2912&login_token=notnullapikey", $customFile->getFileUrlAuthenticated());
    }
}