# Churchtools (CT) API-Client

Churchtools API-Client is a php based wrapper of the churchtools api. This api is tested with the churchtools version
v3.71.0.

## Installation

Go to the project-root and install churchtools-api via [composer](https://getcomposer.org/):

```
composer require 5pm-hdh/churchtools-api
```

Load all the dependency-packages into the PHP-Project with the command:

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
    //important! ApiUrl must end with Top-Level-Domain. No paths allowed!
CTConfig::setApiUrl("https://example.church.tools");

    //authenticates the application and load the api-key into the config
CTConfig::authWithCredentials(
    "example.email@gmx.de",
    "myPassword1234"
);

    // if everything works fine, the api-key is stored in your config
$apiKey = CTConfig::getApiKey();
```

For more information visit the [CTConfig documentation](/docs/CTConfig.md)
From now on all features of the churchtools-api are available. More information to the RequestApi's a in
the [Requests-Documentation](/docs/Requests.md).

### 1. Person-Api

To retrieve data from the api use the Requests-Interfaces. They will provide filter options ("where"-clause) and
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
                    ->orderBy('birthday')
                    ->get();
                    
foreach($teenager as $teenPerson){
    echo "Hello Teenager with E-Mail: ".$teenPerson->getEmail();
}

// Get specific Person
$personA = PersonRequest::find(21);     // returns "null" if id is invalid
$personB = PersonRequest::findOrFail(22); // throws exception if id is invalid
```

### 2. Event-Api

```php
use CTApi\Requests\EventRequest;

// Retrieve all events
$allEvents = EventRequest::all();

// Filter events in period
$christmasServices = EventRequest::where('from', '2020-12-24')
                    ->where('to', '2020-12-26')
                    ->orderBy('id')
                    ->get();
                    
foreach($christmasServices as $service){
    echo "Christmas service: " . $service->getName();
}

// Get specific Person
$eventRequest = EventRequest::find(21);     // returns "null" if id is invalid
$eventRequest = EventRequest::findOrFail(22); // throws exception if id is invalid
```

## License

This project is licensed under MIT-License feel free to use it or to contribute.