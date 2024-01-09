<?php

namespace CTApi\Models\Common\Info;

use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;

class InfoRequest
{
    /**
     * Request Info of ChurchTools-Instance.
     * @return array contains keys: <code>build</code>, <code>shortName</code>, <code>siteName</code> and <code>version</code>
     */
    public static function getInfo(): array
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/info');
        return CTResponseUtil::jsonToArray($response);
    }
}
