<?php

namespace Tests\Integration\Models;

use CTApi\CTConfig;
use CTApi\Models\File;
use CTApi\Requests\SongRequest;
use Tests\Integration\TestCaseAuthenticated;

class FileTest extends TestCaseAuthenticated
{
    private string $DOWNLOAD_FOLDER = __DIR__ . "/download-folder";

    public function testDownloadFileToPath()
    {
        $exampleFile = $this->collectFile();

        $exampleFile->downloadToPath($this->DOWNLOAD_FOLDER);

        $this->assertFileExistsInDownloadFolder($exampleFile);
    }

    private function collectFile(): File
    {
        $allSongs = SongRequest::orderBy('id', false)->get();

        foreach ($allSongs as $song) {

            foreach ($song->getArrangements() as $arrangement) {
                foreach ($arrangement->getFiles() as $file) {
                    return $file;
                }
            }
        }
        return new File();
    }

    private function assertFileExistsInDownloadFolder(File $file)
    {
        $this->assertTrue(
            file_exists($this->DOWNLOAD_FOLDER . '/' . $file->getFilename())
            ||
            file_exists($this->DOWNLOAD_FOLDER . '/' . $file->getName())
        );
    }

    public function testGetFileUrlAuthenticated()
    {
        $file = new File();

        $this->assertNull($file->getFileUrlAuthenticated());

        $apiToken = CTConfig::getApiKey();
        $file->setFileUrl("https//file.com/?id=291");
        $this->assertEquals("https//file.com/?id=291&login_token=" . $apiToken, $file->getFileUrlAuthenticated());
    }

    public function testGetFileUrlBaseUrl()
    {
        $file = new File();

        $baseUrl = $file->getFileUrlBaseUrl();
        $this->assertNull($baseUrl);

        $baseUrl = $file->setFileUrl('https://google.com')->getFileUrlBaseUrl();
        $this->assertEquals('https://google.com', $baseUrl);

        $baseUrl = $file->setFileUrl('https://google.com/searchresult')->getFileUrlBaseUrl();
        $this->assertEquals('https://google.com/searchresult', $baseUrl);

        $baseUrl = $file->setFileUrl('https://google.com/searchresult?q=2913')->getFileUrlBaseUrl();
        $this->assertEquals('https://google.com/searchresult', $baseUrl);
    }

    public function testGetFileUrlQueryParameters()
    {
        $file = new File();

        $query = $file->getFileUrlQueryParameters();
        $this->assertEmpty($query);

        $query = $file->setFileUrl('invalidurlwithnotquery')->getFileUrlQueryParameters();
        $this->assertEmpty($query);

        $query = $file->setFileUrl('https://google.com/?id=29123')->getFileUrlQueryParameters();
        $this->assertEquals(29123, $query['id']);

        $query = $file->setFileUrl('https://google.com/?id=29123&name=hans')->getFileUrlQueryParameters();
        $this->assertEquals(29123, $query['id']);
        $this->assertEquals("hans", $query['name']);
    }
}
