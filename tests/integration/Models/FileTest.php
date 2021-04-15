<?php


use CTApi\CTConfig;
use CTApi\Models\File;
use CTApi\Requests\SongRequest;

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
}
