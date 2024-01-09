<?php

namespace CTApi\Models\Common\File;

use CTApi\CTClient;

class FileRequest
{
    public static function forAvatar(int $personId): FileRequestBuilder
    {
        return new FileRequestBuilder("avatar", $personId);
    }

    public static function forGroupImage(int $groupId): FileRequestBuilder
    {
        return new FileRequestBuilder("groupimage", $groupId);
    }

    public static function forLogo(int $logoId): FileRequestBuilder
    {
        return new FileRequestBuilder("logo", $logoId);
    }

    public static function forAttatchment(int $attatchmentId): FileRequestBuilder
    {
        return new FileRequestBuilder("attatchments", $attatchmentId);
    }

    public static function forHtmlTemplate(int $htmlTemplateId): FileRequestBuilder
    {
        return new FileRequestBuilder("html_template", $htmlTemplateId);
    }

    public static function forEvent(int $eventId): FileRequestBuilder
    {
        return new FileRequestBuilder("service", $eventId);
    }

    public static function forSongArrangement(int $songArrangement): FileRequestBuilder
    {
        return new FileRequestBuilder("song_arrangement", $songArrangement);
    }

    public static function forImportTable(int $importTableId): FileRequestBuilder
    {
        return new FileRequestBuilder("importtable", $importTableId);
    }

    public static function forPerson(int $personId): FileRequestBuilder
    {
        return new FileRequestBuilder("person", $personId);
    }

    public static function forFamilyAvatar(int $familyavatarId): FileRequestBuilder
    {
        return new FileRequestBuilder("familyavatar", $familyavatarId);
    }

    /**
     * Updates the Attribute "name" (displayed in ChurchTools) of a given in File.
     * @param File $file
     * @param string $newFilename
     */
    public static function updateName(File $file, string $newFilename): void
    {
        $client = CTClient::getClient();
        $client->patch('/api/files/' . $file->getIdOrFail(), [
            "json" => ["name" => $newFilename]
        ]);

        $file->setName($newFilename);
    }

    /**
     * Deletes file.
     * @param File $file
     */
    public static function deleteFile(File $file): void
    {
        $client = CTClient::getClient();
        $client->delete('/api/files/' . $file->getIdOrFail());
    }
}
