# CTConfig

## 1. API-Url
As a first configuration step you need to define the api-url of your churchtools application. The Url must end with the toplevel-domain no paths are allowed:

*Invalid Urls:* 
* https://intern.church.tools/api
* https://intern.church.tools/#WikiView/filterWikicategory_id:0/doc:main/

*Valid Urls:*
* https://intern.church.tools

```php
use CTApi\CTConfig;


$apiUrl = "https://intern.church.tools";


CTConfig::setApiUrl();
```

## 2. Authentication
Next you need to authenticate yourself at the api. You can use the `AuthRequest` or use the `CTConfig::authWithCredentials` method:
```php
$email = "someEmail@example.com";
$password = "1234churchtools"

CTConfig::authWithCredentials($email, $password);
```

This method will log in to the application to the churchtools api and retrieve the api key. For security reasons the CTConfig don't store your email or password. Only the api key will be stored. You can display the api key by using the getter method:

```php
$apiToken = CTConfig::getApiKey();
```