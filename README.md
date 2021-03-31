# Churchtools (CT) API-Client

## Configuration

Set up the configuration with the `CTConfig`-API:

```php
use \CTApi\CTConfig;

    //set the url of your churchtools application api
CTConfig::setApiUrl("https://example.church.tools/api");

    //authenticates the application and retrieve the api-key
CTConfig::authWithCredentials(
    "example.email@gmx.de",
    "myPassword1234"
);

CTConfig::getApiKey();
```