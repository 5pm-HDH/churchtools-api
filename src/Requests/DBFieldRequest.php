<?php


namespace Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTRequestException;
use CTApi\Utils\CTResponseUtil;
use Models\DBField;

class DBFieldRequest
{
    public static function all(): array
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/dbfields');
        $data = CTResponseUtil::dataAsArray($response);
        return DBField::createModelsFromArray($data);
    }

    public static function find(int $dbFieldId): ?DBField
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/dbfields/' . $dbFieldId);
        $data = CTResponseUtil::dataAsArray($response);
        if (!empty($data)) {
            return DBField::createModelFromData($data);
        } else {
            return null;
        }
    }

    public static function findOrFail(int $dbFieldId): DBField
    {
        $model = self::find($dbFieldId);
        if ($model != null) {
            return $model;
        } else {
            throw CTRequestException::ofModelNotFound(DBField::class);
        }
    }
}