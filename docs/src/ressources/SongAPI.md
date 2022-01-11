# SongAPI

```php
use CTApi\Models\File;
use CTApi\Requests\SongRequest;

$allSongs = SongRequest::all();
$practiceSong = SongRequest::where('practice', true)->orderBy('name')->get();

$songs = SongRequest::where('key_of_arrangement', 'G')->get();
$songs = SongRequest::where('song_category_ids', [29,30])->get();

$song = SongRequest::findOrFail(21);

/**
 * Song-Model 
 */
dd($song->getId());
dd($song->getName());
dd($song->getShouldPractice());
dd($song->getAuthor());
dd($song->getCcli());
dd($song->getCopyright());
dd($song->getNote());

// only if arrangement is select (e.q. agenda)
dd($song->getArrangement());
dd($song->getKey());
dd($song->getBpm());
dd($song->getIsDefault());

$selectedArrangement = $song->requestSelectedArrangement();

$firstArrangement = $song->getArrangements()[0];

/**
 * Arrangement-Model
 */
dd($selectedArrangement->getId());
dd($selectedArrangement->getName());
dd($selectedArrangement->getIsDefault());
dd($selectedArrangement->getKeyOfArrangement());
dd($selectedArrangement->getBpm());
dd($selectedArrangement->getBeat());
dd($selectedArrangement->getDuration());
dd($selectedArrangement->getNote());
dd($selectedArrangement->getLinks());
dd($selectedArrangement->getFiles());


/**
 *  File-Model
 */
foreach($selectedArrangement->getFiles() as $file){
    dd($file->getDomainType());
    dd($file->getDomainId());
    dd($file->getName());
    dd($file->getFilename());
    dd($file->getFileUrl());
}

$chordsheet = $selectedArrangement->requestFirstFile('chord', 'pdf');
$youtubeLink = $selectedArrangement->requestFirstLink('youtube.com');

// Download File:
//$chordsheet->downloadToClient(); //downloads to client
//$chordsheet->downloadToPath(__DIR__.'/files');

$customFile = File::createModelFromData([
    'fileUrl' => 'https://multitracks.com/path/to/song?id=2912'
]);

dd($customFile->getFileUrlBaseUrl());
dd($customFile->getFileUrlQueryParameters()); 
dd($customFile->getFileUrlAuthenticated());
```