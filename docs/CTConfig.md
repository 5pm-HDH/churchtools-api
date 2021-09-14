# CTConfig

## 1. API-Url

As a first configuration step you need to define the api-url of your churchtools application. The Url must end with the
toplevel-domain no paths are allowed:

*Invalid Urls:*

* https://intern.church.tools/api
* https://intern.church.tools/#WikiView/filterWikicategory_id:0/doc:main/

*Valid Urls:*

* https://intern.church.tools

```php
use CTApi\CTConfig;


$apiUrl = "https://intern.church.tools";


CTConfig::setApiUrl($apiUrl);
```

## 2. Authentication

Next you need to authenticate yourself at the api. You can use the `AuthRequest` or use
the `CTConfig::authWithCredentials` method:

```php
$email = "someEmail@example.com";
$password = "1234churchtools";

CTConfig::authWithCredentials($email, $password);
```

This method will log in to the application to the churchtools api and retrieve the api key. For security reasons the
CTConfig don't store your email or password. Only the api key will be stored. You can display the api key by using the
getter method:

```php
$apiToken = CTConfig::getApiKey();
```

The api key can also be set manually with the setter method:

```php
$apiToken = CTConfig::setApiKey("...");
```

To validate if the api key is still valid, call the validateApiKey method:

```php
$isValid = CTConfig::validateApiKey();
if($isValid){
    echo "ApiKey is still valid!";
}else{
    echo "ApiKey is not valid anymore!";
}
```

## 3. Cache Requests

To increase performance enable the caching-mechanism with:

```php
use CTApi\CTConfig;

// enable caching of http-requests
CTConfig::enableCache();

// disable caching of http-requests
CTConfig::disableCache();

// clear stored cache
CTConfig::clearCache();
```

By default the cache-files will be stored in the /cache directory. Only `GET`-Requests will be stored in the cache (
not `POST`/`PUT`).

You can disable the cache from single requests by adding the `Cache-Control`-Header with the value `no-cache`. Example
Request:

```php
$response = $client->get(
                '/api/persons/' . $this->userId . '/logintoken',
                [
                    'headers' => [
                        'Cache-Control' => 'no-cache'
                    ]
                ]
            );
```