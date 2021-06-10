<?php


namespace CTApi\Utils;


use Psr\Http\Message\RequestInterface;

class CTCacheResponse extends CTResponse
{
    public static function createFromRequestAndData(RequestInterface $request, array $data): CTCacheResponse
    {
        $response = new CTCacheResponse($request->getHeaders());
        $response->withBody(new CTMessageBody($data));
        return $response;
    }
}