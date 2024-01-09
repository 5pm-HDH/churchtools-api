<?php

namespace CTApi\Models\Common\Config;

use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;

class ConfigRequest
{
    /**
     * Request Config of ChurchTools-Instance.
     * @return array contains keys: <code>build</code>, <code>shortName</code>, <code>siteName</code> and <code>version</code>
     */
    public static function getConfig(): array
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/config');
        return CTResponseUtil::jsonToArray($response);
    }
}
