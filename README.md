# Churchtools (CT) API-Client

## Installation

Go to your project-root and install churchtools-api via [composer](https://getcomposer.org/):

```
composer require 5pm-hdh/churchtools-api
```

Load all the dependency-packages into your PHP-Project with the command:

```php
<?php

include_once 'vendor/autoload.php';
```

## Usage

Before you can start to request data from the API you need to **configure the CT-Client (churchtools client)** with
the `CTConfig`-interface:

```php
use \CTApi\CTConfig;

    //set the url of your churchtools application api
CTConfig::setApiUrl("https://example.church.tools/api");

    //authenticates the application and load the api-key into the config
CTConfig::authWithCredentials(
    "example.email@gmx.de",
    "myPassword1234"
);

    // if everything works fine, the api-key is stored in your config
$apiKey = CTConfig::getApiKey();
```

From now on you can use all the features fo the churchtools-api:

### 1. Person-Api

To retrieve data from the api you can use the Requests-Interfaces. They will provide filter options ("where"-clause) and
concatenation of filter through the fluent api.

```php
use CTApi\Requests\PersonRequest;

$myself = PersonRequest::whoami();
echo "Hello ".$myself->getLastName() . $myself->getFirstName();

// Retrieve all Persons
$allPersons = PersonRequest::all();

// Filter Data with Where-Clause
$teenager = PersonRequest::where('birthday_before', '2007-01-01')
                    ->where('birthday_after', '2003-01-01')
                    ->get();
                    
foreach($teenager as $teenPerson){
    echo "Hello Teenager with E-Mail: ".$teenPerson->getEmail();
}

// Get specific Person
$personA = PersonRequest::find(21);     // returns "null" if id is invalid
$personB = PersonRequest::findOrFail(22); // throws exception if id is invalid
```

## License

This project is licensed under MIT-License feel free to use it or to contribute.