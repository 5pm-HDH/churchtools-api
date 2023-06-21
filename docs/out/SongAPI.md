# SongAPI

## Request Song

```php
        use CTApi\Models\File;
        use CTApi\Models\Song;
        use CTApi\Models\SongArrangement;
        use CTApi\Requests\SongArrangementRequest;
        use CTApi\Requests\SongRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

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

## Retrieve tags for song

```php
        use CTApi\Requests\SongRequest;
        use CTApi\Requests\TagRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $song = SongRequest::findOrFail(21);
        $tags = $song->requestTags()?->get() ?? [];

        $tagList = "";
        foreach ($tags as $tag) {
            $tagList .= $tag->getName() . " (#" . $tag->getId() . "); ";
        }

        var_dump( $tagList);
        // Output: "5pm Songpool (#5); Youth Songpool (#11); "


```

## Update Song

```php
        use CTApi\Models\File;
        use CTApi\Models\Song;
        use CTApi\Models\SongArrangement;
        use CTApi\Requests\SongArrangementRequest;
        use CTApi\Requests\SongRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $song = SongRequest::findOrFail(21);

        // Attributes that can be updated with ChurchTools-Api
        var_dump( implode("; ", Song::getModifiableAttributes()));
        // Output: "name; category_id; shouldPractice; author; copyright; ccli"


        $song->setName("New Arrangement Title");
        $song->setShouldPractice(true);

        SongRequest::update($song);

```

## Update Song-Arrangement

```php
        use CTApi\Models\File;
        use CTApi\Models\Song;
        use CTApi\Models\SongArrangement;
        use CTApi\Requests\SongArrangementRequest;
        use CTApi\Requests\SongRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $song = SongRequest::findOrFail(21);
        $arrangements = $song->getArrangements();
        $arrangement = end($arrangements);

        // Attributes that can be updated with ChurchTools-Api
        var_dump( implode("; ", SongArrangement::getModifiableAttributes()));
        // Output: "name; keyOfArrangement; bpm; beat; duration; note"


        $arrangement->setName("New Arrangement Title");
        SongArrangementRequest::update($arrangement);

```

## Retrieve Data from CCLI

**Retrieve Lyrics for CCLI-Number:**

```php
        use CTApi\Requests\CcliRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $ccliNumber = 1878670;

        $songLyrics = CcliRequest::forSong($ccliNumber)->retrieveLyrics();

        $this->assertNotNull($songLyrics);
        var_dump( $songLyrics->getCclid());
        // Output: "1878670"

        $authorList = implode("/", $songLyrics->getAuthors());
        var_dump( $authorList);
        // Output: "Andres Figueroa/Hank Bentley/Mariah McManus/Mia Fieldes"

        $copyright = implode("/", $songLyrics->getCopyrights());
        var_dump( $copyright);
        // Output: "2016 All Essential Music/Be Essential Songs/Bentley Street Songs/Mosaic LA Music/Mosaic MSC Music/Tempo Music Investments"

        var_dump( $songLyrics->getDisclaimer());
        // Output: "For us solely with the SongSelect Terms of us.  All rights reserved. www.ccli.com"

        var_dump( $songLyrics->getSongID());
        // Output: "4c0ad6fe-402c-e611-9427-0050568927dd"

        var_dump( $songLyrics->getSongNumber());
        // Output: "7065049"

        var_dump( $songLyrics->getTitle());
        // Output: "Tremble"


        // Show second lyrics part:
        var_dump( $songLyrics->getLyricParts()[1]["lyrics"]);
        // Output: "Still call the sea to still\nThe rage in me to still\nEvery wave at Your name"

        var_dump( $songLyrics->getLyricParts()[1]["partType"]);
        // Output: "Verse"

        var_dump( $songLyrics->getLyricParts()[1]["partTypeNumber"]);
        // Output: "2"


```

**Retrieve Chordsheet for CCLI-Number:**

Parameter for the `retrieveChordsheet`-Method:

* SongArrangementId where the chordsheet pdf should be attached
* Filename you want to give the pdf file
* Key of the chordsheet you want to dowload.

The method returns a nullable [File-Model](/../../src/Models/File.php).

- ⚠ If you insert a invalid ccli-number, churchtools creates an empty file. There is no error reported.

```php
        use CTApi\Requests\CcliRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $ccliNumber = 1878670;
        $songArrangementId = 2912;
        $fileNameOfChordsheet = "Tremble Chordsheet";
        $chordsheetKey = "C";

        $chordsheetFile = CcliRequest::forSong($ccliNumber)->retrieveChordsheet($songArrangementId, $fileNameOfChordsheet, $chordsheetKey);

        var_dump( $chordsheetFile?->getFilename());
        // Output: "77fd99.pdf"

        var_dump( $chordsheetFile?->getId());
        // Output: "110"

        var_dump( $chordsheetFile?->getName());
        // Output: "Tremble Chordsheet - C.pdf"

        var_dump( $chordsheetFile?->getFileUrl());
        // Output: "https://example.church.tools//?q=public/filedownload&id=110&filename=77fd99.pdf"


```

## Retrieve Song Statistics

**Get All Statistics:**

```php
        use CTApi\Models\SongStatistic;
        use CTApi\Requests\SongRequest;
        use CTApi\Requests\SongStatisticRequest;
        use CTApi\Requests\SongStatisticRequestBuilder;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $data = SongStatisticRequest::all();

        $songStatistic = end($data);

        var_dump( $songStatistic->getCount());
        // Output: 14

        var_dump( $songStatistic->getCountForCalendars([1, 2]));
        // Output: 11


        // Retrieve Dates:
        $allDates = $songStatistic->getDates();
        $date = end($allDates);
        var_dump( $date["date"]);
        // Output: '2021-12-12 10:30:00'

        var_dump( $date["calendar_id"]);
        // Output: '3'


        $datesForMyServies = $songStatistic->getDatesForCalendars([1, 2]);
        $dateService = end($datesForMyServies);
        var_dump( $dateService["date"]);
        // Output: '2021-07-11 10:30:00'

        var_dump( $dateService["calendar_id"]);
        // Output: '2'


```

**Get Statistics for Song-Arrangement:**

```php
        use CTApi\Models\SongStatistic;
        use CTApi\Requests\SongRequest;
        use CTApi\Requests\SongStatisticRequest;
        use CTApi\Requests\SongStatisticRequestBuilder;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $statistics = SongStatisticRequest::findOrFail("21");

        var_dump( 8);
        // Output: $statistics->getCount()

        var_dump( 5);
        // Output: $statistics->getCountForCalendars([2])

        var_dump( 0);
        // Output: $statistics->getCountForCalendars([21])


```

**Lazy-Builder:**

```php
        use CTApi\Models\SongStatistic;
        use CTApi\Requests\SongRequest;
        use CTApi\Requests\SongStatisticRequest;
        use CTApi\Requests\SongStatisticRequestBuilder;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        /**
         * Lazy-SongStatisticRequestBuilder
         */
        $requestBuilderLazy = new SongStatisticRequestBuilder(); // default: lazy-flag is true

        $requestBuilderLazy->find("21");
        $requestBuilderLazy->find("22");

        // The whole song-statistic will be fetched ones and used for both "find"-calls.

        /**
         * Not-Lazy-SongStatisticRequestBuilder
         */

        $requestBuilderNotLazy = new SongStatisticRequestBuilder(false);

        $requestBuilderLazy->find("21");
        $requestBuilderLazy->find("22");

        // The whole song-statistic will be fetched for every "find"-call.

```
