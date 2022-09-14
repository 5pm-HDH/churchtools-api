<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\File;

class FileRequest
{
    public static function forAvatar(int $personId): FileRequestBuilder
    {
        return new FileRequestBuilder("avatar", $personId);
    }

    public static function forSongArrangement(int $songArrangement): FileRequestBuilder
    {
        return new FileRequestBuilder("song_arrangement", $songArrangement);
    }

    /**
     * Updates the Attribute "name" (displayed in ChurchTools) of a given in File.
     * @param File $file
     * @param string $newFilename
     */
    public static function updateName(File $file, string $newFilename): void
    {
        if (is_null($file->getId())) {
            throw new CTModelException("Id in file is missing.");
        }

        $client = CTClient::getClient();
        $client->patch('/api/files/' . $file->getId(), [
            "json" => ["name" => $newFilename]
        ]);

        $file->setName($newFilename);
    }
}