# SongAPI

```php
use CTApi\Models\File;use CTApi\Requests\SongRequest;

$allSongs = SongRequest::all();
$practiceSong = SongRequest::where('practice', true)->orderBy('name')->get();

$songs = SongRequest::where('key_of_arrangement', 'G')->get();
$songs = SongRequest::where('song_category_ids', [29,30])->get();

$song = SongRequest::find(29);

/**
 * Song-Model 
 */
echo "-".$song->getId();
echo "-".$song->getName();
echo "-".$song->getShouldPractice();
echo "-".$song->getAuthor();
echo "-".$song->getCcli();
echo "-".$song->getCopyright();
echo "-".$song->getNote();

// only if arrangement is select (e.q. agenda)
echo "-".$song->getArrangement();
echo "-".$song->getKey();
echo "-".$song->getBpm();
echo "-".$song->getIsDefault();

$selectedArrangement = $song->requestSelectedArrangement();

$firstArrangement = $song->getArrangements()[0];

/**
 * Arrangement-Model
 */
echo "-".$selectedArrangement->getId();
echo "-".$selectedArrangement->getName();
echo "-".$selectedArrangement->getIsDefault();
echo "-".$selectedArrangement->getKeyOfArrangement();
echo "-".$selectedArrangement->getBpm();
echo "-".$selectedArrangement->getBeat();
echo "-".$selectedArrangement->getDuration();
echo "-".$selectedArrangement->getNote();
print_r($selectedArrangement->getLinks());
print_r($selectedArrangement->getFiles());


/**
 *  File-Model
 */
foreach($selectedArrangement->getFiles() as $file){
    echo "-".$file->getDomainType();
    echo "-".$file->getDomainId();
    echo "-".$file->getName();
    echo "-".$file->getFilename();
    echo "-".$file->getFileUrl();
}

$chordsheet = $selectedArrangement->requestFirstFile('chord', 'pdf');
$youtubeLink = $selectedArrangement->requestFirstLink('youtube.com');


$chordsheet->downloadToClient(); //downloads to client
$chordsheet->downloadToPath(__DIR__.'/files');

$customFile = File::createModelFromData([
    'fileUrl' => 'https://multitracks.com/path/to/song?id=2912'
]);

echo "-".$customFile->getFileUrlBaseUrl(); // Output: https://multitracks.com/path/to/song
print_r($customFile->getFileUrlQueryParameters()); // Output: [ [id] => 2912 ] 
echo "-".$customFile->getFileUrlAuthenticated(); // Output: https://multitracks.com/path/to/song?id=2912&login_token=K2lWk2Mn

```