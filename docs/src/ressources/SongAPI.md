# SongAPI

## Request Song

{{ \Tests\Unit\Docs\SongRequestTest.testExampleCode }}

## Update Song

{{ \Tests\Unit\Docs\SongRequestTest.testUpdateSong }}

## Update Song-Arrangement

{{ \Tests\Unit\Docs\SongRequestTest.testUpdateArrangement }}

## Retrieve Data from CCLI

**Retrieve Lyrics for CCLI-Number:**

{{ \Tests\Unit\Docs\CcliRequestTest.testRetrieveLyrics }}

**Retrieve Chordsheet for CCLI-Number:**

Parameter for the `retrieveChordsheet`-Method:

* SongArrangementId where the chordsheet pdf should be attached
* Filename you want to give the pdf file
* Key of the chordsheet you want to dowload.

The method returns a nullable [File-Model](/../../src/Models/File.php).

- ⚠ If you insert a invalid ccli-number, churchtools creates an empty file. There is no error reported.

{{ \Tests\Unit\Docs\CcliRequestTest.testRetrieveChordsheet }}

## Retrieve Song Statistics

**Get All Statistics:**

{{ \Tests\Unit\Docs\SongStatisticRequestTest.testGetAll }}

**Get Statistics for Song:**

{{ \Tests\Unit\Docs\SongStatisticRequestTest.testGetViaSong }}

**Lazy-Builder:**

{{ \Tests\Unit\Docs\SongStatisticRequestTest.testLazy }}
