# SongAPI

```php
        use CTApi\Models\File;
        use CTApi\Requests\SongRequest;

        $allSongs = SongRequest::all();
        $practiceSong = SongRequest::where('practice', true)->orderBy('name')->get();

        $songs = SongRequest::where('key_of_arrangement', 'G')->get();
        $songs = SongRequest::where('song_category_ids', [29, 30])->get();

        $song = SongRequest::findOrFail(21);

        /**
         * Song-Model
         */
        var_dump( $song->getId());
        // Output: "21"

        var_dump( $song->getName());
        // Output: "We welcome you"

        var_dump( $song->getShouldPractice());
        // Output: "1"

        var_dump( $song->getAuthor());
        // Output: "Michael W. Smith"

        var_dump( $song->getCcli());
        // Output: "C9219"

        var_dump( $song->getCopyright());
        // Output: "Worship Music"

        var_dump( $song->getNote());
        // Output: "Nothing to note."


        // only if arrangement is select (e.q. agenda)
        var_dump( $song->getArrangement());
        // Output: ""

        var_dump( $song->getKey());
        // Output: ""

        var_dump( $song->getBpm());
        // Output: ""

        var_dump( $song->getIsDefault());
        // Output: ""


        $selectedArrangement = $song->requestSelectedArrangement();

        $firstArrangement = $song->getArrangements()[0];

        /**
         * Arrangement-Model
         */
        var_dump( $selectedArrangement?->getId());
        // Output: "221"

        var_dump( $selectedArrangement?->getName());
        // Output: "In A-Dur"

        var_dump( $selectedArrangement?->getIsDefault());
        // Output: "1"

        var_dump( $selectedArrangement?->getKeyOfArrangement());
        // Output: "A"

        var_dump( $selectedArrangement?->getBpm());
        // Output: "120"

        var_dump( $selectedArrangement?->getBeat());
        // Output: "4/4"

        var_dump( $selectedArrangement?->getDuration());
        // Output: "210"

        var_dump( $selectedArrangement?->getNote());
        // Output: "-"

        $selectedArrangement?->getLinks();
        $selectedArrangement?->getFiles();


        /**
         *  File-Model
         */
        foreach (($selectedArrangement?->getFiles() ?? []) as $file) {
            var_dump( $file->getDomainType());
        // Output: ""

            var_dump( $file->getDomainId());
        // Output: ""

            var_dump( $file->getName());
        // Output: "chords-a.pdf"

            var_dump( $file->getFilename());
        // Output: "chords-a.pdf"

            var_dump( $file->getFileUrl());
        // Output: "https://some-churchtools-api-url.com/"

        }

        $chordsheet = $selectedArrangement?->requestFirstFile('chord', 'pdf');
        $youtubeLink = $selectedArrangement?->requestFirstLink('youtube.com');

        // Download File:
        //$chordsheet->downloadToClient(); //downloads to client
        //$chordsheet->downloadToPath(__DIR__.'/files');

        $customFile = File::createModelFromData([
            'fileUrl' => 'https://multitracks.com/path/to/song?id=2912'
        ]);

        var_dump( $customFile->getFileUrlBaseUrl());
        // Output: "https://multitracks.com/path/to/song"

        var_dump( $customFile->getFileUrlQueryParameters());
        // Output: ["id" => "2912"]

        var_dump( $customFile->getFileUrlAuthenticated());
        // Output: "https://multitracks.com/path/to/song?id=2912&login_token=notnullapikey"


```