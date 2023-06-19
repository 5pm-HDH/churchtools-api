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
use CTApi\CTConfig;

$email = "someEmail@example.com";
$password = "1234churchtools";

CTConfig::authWithCredentials($email, $password);
```

This method will log in to the application to the churchtools api and set the session cookie. For security reasons the
CTConfig don't store your email or password. Only the session cookie will be stored.

If you use multi factor authentication you can add the TOTP-Token as third parameter:

```php
use CTApi\CTConfig;

$email = "someEmail@example.com";
$password = "1234churchtools";
$totp = "291521";

CTConfig::authWithCredentials($email, $password, $totp);
```

To validate if the session is still valid, call the validateAuthentication method:

```php
use CTApi\CTConfig;

$isValid = CTConfig::validateAuthentication();
if($isValid){
    echo "ApiKey is still valid!";
}else{
    echo "ApiKey is not valid anymore!";
}
```

You can also retrieve the api key to authenticate the CTConfig.

```php
use CTApi\Requests\AuthRequest;

$userId = 21;

AuthRequest::retrieveApiToken($userId);
```

Authenticate via login-token:

```php
use CTApi\CTConfig;

$auth = CTConfig::authWithLoginToken("<login-token>");
$auth->userId;
```

Authenticate via old ajax-api with user-id and login-token:

```php
use CTApi\CTConfig;

$success = CTConfig::authWithUserIdAndLoginToken("29", "<login-token>");
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
$client = new \CTApi\CTClient();
$userId = 21;

$response = $client->get(
                '/api/persons/' . $userId. '/logintoken',
                [
                    'headers' => [
                        'Cache-Control' => 'no-cache'
                    ]
                ]
            );
```

## 4. Pagination

Set Page-Size of Pagination-Requests.

```php
use CTApi\CTConfig;

CTConfig::setPaginationPageSize(400);
```

## 5. CSRF-Token

{{ \Tests\Unit\Docs\CSRFTokenRequestTest.testGetCSRFToken }}
