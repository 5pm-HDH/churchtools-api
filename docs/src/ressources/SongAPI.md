# SongAPI

## Request Song

{{ \CTApi\Test\Unit\Docs\SongRequestTest.testExampleCode }}

## Retrieve tags for song

{{ \CTApi\Test\Unit\Docs\TagsRequestTest.testRetrieveTagForSong }}

## Update Song

{{ \CTApi\Test\Unit\Docs\SongRequestTest.testUpdateSong }}

## Update Song-Arrangement

{{ \CTApi\Test\Unit\Docs\SongRequestTest.testUpdateArrangement }}

## Retrieve Data from CCLI

**Retrieve Lyrics for CCLI-Number:**

{{ \CTApi\Test\Unit\Docs\CcliRequestTest.testRetrieveLyrics }}

**Retrieve Chordsheet for CCLI-Number:**

Parameter for the `retrieveChordsheet`-Method:

* SongArrangementId where the chordsheet pdf should be attached
* Filename you want to give the pdf file
* Key of the chordsheet you want to dowload.

The method returns a nullable [File-Model](/../../src/Models/File.php).

- ⚠ If you insert a invalid ccli-number, churchtools creates an empty file. There is no error reported.

{{ \CTApi\Test\Unit\Docs\CcliRequestTest.testRetrieveChordsheet }}

## Retrieve Song Statistics

**Get All Statistics:**

{{ \CTApi\Test\Unit\Docs\SongStatisticRequestTest.testGetAll }}

**Get Statistics for Song-Arrangement:**

{{ \CTApi\Test\Unit\Docs\SongStatisticRequestTest.testGetViaSongArrangement }}

**Lazy-Builder:**

{{ \CTApi\Test\Unit\Docs\SongStatisticRequestTest.testLazy }}
