<?php


namespace Tests\Integration\Requests;


use CTApi\Exceptions\CTRequestException;
use CTApi\Models\File;
use CTApi\Requests\FileRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class FileRequestMultipleFilesTest extends TestCaseAuthenticated
{
    private string $nameFileA = "fileA.txt";
    private string $pathFileA = __DIR__ . '/resources/fileA.txt';
    private string $nameFileB = "fileB.md";
    private string $pathFileB = __DIR__ . '/resources/fileB.md';

    private int $eventId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventId = IntegrationTestData::getFilterAsInt("get_event", "event_id");

        // No Files should be uploaded at the beginning of any unit-test
        FileRequest::forEvent($this->eventId)->delete();
        $this->assertFile($this->nameFileA, false);
        $this->assertFile($this->nameFileB, false);
    }

    public function testUploadTwoFiles()
    {
        // Upload Files
        $fileA = FileRequest::forEvent($this->eventId)->upload($this->pathFileA);
        $fileB = FileRequest::forEvent($this->eventId)->upload($this->pathFileB);

        // Files should be uploaded:
        $this->assertFile($this->nameFileA, true);
        $this->assertFile($this->nameFileB, true);

        // Delete all Files
        FileRequest::forEvent($this->eventId)->delete();
        $this->assertFile($this->nameFileA, false);
        $this->assertFile($this->nameFileB, false);
    }

    public function testDeleteOneFile()
    {
        // Upload Files
        $fileA = FileRequest::forEvent($this->eventId)->upload($this->pathFileA);
        $fileB = FileRequest::forEvent($this->eventId)->upload($this->pathFileB);
        $this->assertNotNull($fileA);
        $this->assertNotNull($fileB);

        // Files should be uploaded:
        $this->assertFile($this->nameFileA, true);
        $this->assertFile($this->nameFileB, true);

        // Delete FileA
        FileRequest::deleteFile($fileA);
        $this->assertFile($this->nameFileA, false);
        $this->assertFile($this->nameFileB, true);

        // Delete FileB
        FileRequest::deleteFile($fileB);
        $this->assertFile($this->nameFileA, false);
        $this->assertFile($this->nameFileB, false);

    }

    public function testDeleteOneFileMultipleTimes()
    {
        // Upload File A
        $fileA = FileRequest::forEvent($this->eventId)->upload($this->pathFileA);
        $this->assertNotNull($fileA);
        $this->assertFile($this->nameFileA, true);

        // Delete FileA the first time
        FileRequest::deleteFile($fileA);

        // Delete FileA the second time
        $this->expectException(CTRequestException::class);
        FileRequest::deleteFile($fileA);
    }

    private function assertFile(string $fileName, bool $assertIsPresent): ?File
    {
        $files = FileRequest::forEvent($this->eventId)->get();
        foreach ($files as $file) {
            if ($file->getName() == $fileName) {
                if (!$assertIsPresent) {
                    $this->fail("File " . $fileName . " is uploaded but asserted to be not present.");
                } else {
                    $this->assertTrue(true);
                }
                return $file;
            }
        }

        if ($assertIsPresent) {
            $this->fail("File " . $fileName . " is not uploaded but asserted to be present.");
        } else {
            $this->assertTrue(true);
        }
        return null;
    }
}