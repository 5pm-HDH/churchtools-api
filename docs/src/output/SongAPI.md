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
echo ($song->getId());
// OUTPUT: 21
echo ($song->getName());
// OUTPUT: We welcome you
echo ($song->getShouldPractice());
// OUTPUT: 1
echo ($song->getAuthor());
// OUTPUT: Michael W. Smith
echo ($song->getCcli());
// OUTPUT: C9219
echo ($song->getCopyright());
// OUTPUT: Worship Music
echo ($song->getNote());
// OUTPUT: Nothing to note.

// only if arrangement is select (e.q. agenda)
echo ($song->getArrangement());
// OUTPUT: 
echo ($song->getKey());
// OUTPUT: 
echo ($song->getBpm());
// OUTPUT: 
echo ($song->getIsDefault());
// OUTPUT: 

$selectedArrangement = $song->requestSelectedArrangement();

$firstArrangement = $song->getArrangements()[0];

/**
 * Arrangement-Model
 */
echo ($selectedArrangement->getId());
// OUTPUT: 221
echo ($selectedArrangement->getName());
// OUTPUT: In A-Dur
echo ($selectedArrangement->getIsDefault());
// OUTPUT: 1
echo ($selectedArrangement->getKeyOfArrangement());
// OUTPUT: A
echo ($selectedArrangement->getBpm());
// OUTPUT: 120
echo ($selectedArrangement->getBeat());
// OUTPUT: 4/4
echo ($selectedArrangement->getDuration());
// OUTPUT: 210
echo ($selectedArrangement->getNote());
// OUTPUT: -
echo ($selectedArrangement->getLinks());
// OUTPUT: [{}]
echo ($selectedArrangement->getFiles());
// OUTPUT: [{}]


/**
 *  File-Model
 */
foreach($selectedArrangement->getFiles() as $file){
    echo ($file->getDomainType());
// OUTPUT: 
    echo ($file->getDomainId());
// OUTPUT: 
    echo ($file->getName());
// OUTPUT: chords-a.pdf
    echo ($file->getFilename());
// OUTPUT: chords-a.pdf
    echo ($file->getFileUrl());
// OUTPUT: https://some-churchtools-api-url.com/
}

$chordsheet = $selectedArrangement->requestFirstFile('chord', 'pdf');
$youtubeLink = $selectedArrangement->requestFirstLink('youtube.com');

// Download File:
//$chordsheet->downloadToClient(); //downloads to client
//$chordsheet->downloadToPath(__DIR__.'/files');

$customFile = File::createModelFromData([
    'fileUrl' => 'https://multitracks.com/path/to/song?id=2912'
]);

echo ($customFile->getFileUrlBaseUrl());
// OUTPUT: https://multitracks.com/path/to/song
echo ($customFile->getFileUrlQueryParameters()); 
// OUTPUT: {"id":"2912"}
echo ($customFile->getFileUrlAuthenticated()); 
// OUTPUT: https://multitracks.com/path/to/song?id=2912&login_token=exampleapikey


```