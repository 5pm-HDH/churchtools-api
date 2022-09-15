# Churchtools (CT) API-Client

![example workflow](https://github.com/5pm-HDH/churchtools-api/actions/workflows/unit-tests.yml/badge.svg)

![example workflow](https://github.com/5pm-HDH/churchtools-api/actions/workflows/static-code-analysis.yml/badge.svg)


ChurchTools API-Client is a php based wrapper of the ChurchTools api. This api is tested with the ChurchTools version <version>3.89.0</version>

## Installation

Go to the project-root and install ChurchTools-api via [composer](https://getcomposer.org/):

```
composer require 5pm-hdh/churchtools-api
```

Load all the dependency-packages into the PHP-Project with the command:

```php
<?php

include_once 'vendor/autoload.php';
```

## Usage

Before you can start to request data from the API you need to **configure the CT-Client (ChurchTools client)** with
the `CTConfig`-interface:

```php
use \CTApi\CTConfig;

    //set the url of your ChurchTools application api
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

For more information visit the [CTConfig documentation](/docs/out/CTConfig.md)
From now on all features of the ChurchTools-api are available.

### Requests and Models

The whole ChurchTools-api client is build on top of the Requests and Models. [Requests](/docs/out/Requests.md) provide an
interface to specify your api call by adding filtering, pagination and sorting. [Models](/docs/out/Models.md) represent the data, that
the Requests retrieve. More informations can be found in the documentation.

All APIs with examples:
* [Person-API](/docs/out/PersonAPI.md)
* [Group-API](/docs/out/GroupAPI.md)
* [Calendar-API](/docs/out/CalendarAPI.md)
* [Resource- and Bookings-API](/docs/out/ResourceAPI.md)
* [PublicGroup-API](/docs/out/PublicGroupAPI.md)
* [Event-API](/docs/out/EventAPI.md)
* [Song-API](/docs/out/SongAPI.md)
* [Service-API](/docs/out/ServiceAPI.md)
* [Absence-API](/docs/out/AbsenceAPI.md)
* [Wiki-API](/docs/out/WikiAPI.md)
* [Permission-API](/docs/out/PermissionAPI.md)
* [File-API](/docs/out/FileAPI.md)

The following short examples show the power of this ChurchTools-api client and gives a rough overview over the possibilities:

#### Example: Person-API

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

#### Example: Event-API

```php
use CTApi\Requests\EventAgendaRequest;
use CTApi\Requests\EventRequest;

// Retrieve all events
$allEvents = EventRequest::all();

// Get specific Event
$event = EventRequest::find(21);     // returns "null" if id is invalid
$event = EventRequest::findOrFail(22); // throws exception if id is invalid

// Filter events in period
$christmasServices = EventRequest::where('from', '2020-12-24')
                    ->where('to', '2020-12-26')
                    ->orderBy('id')
                    ->get();
  
$christmasService = $christmasServices[0];
  
// get the Agenda with event id...
$eventId = $christmasServices->getId();
$agenda = EventAgendaRequest::fromEvent($eventId)->get();

// ...or direct on event-Model
$agenda = $event->requestAgenda();

// Use Songs-API
$songsOnChristmas = $agenda->getSongs();

foreach($songsOnChristmas as $song){
    echo $song->getTitle() . " - (Key: " .$song->getKey() . ")";
}
```

#### Example: Wiki-API

```php
use CTApi\Requests\WikiCategoryRequest;

$wikiCategory = WikiCategoryRequest::find(21);

$rootNodeWiki = $wikiCategory->requestWikiPageTree();

echo "<h1>Table of content:</h1>";
echo "<ul class='first-level'>";
    // First Level
foreach($rootNodeWiki->getChildNodes() as $node){
    echo "<li>";
    echo $node->getWikiPage()->getTitle();
    
    echo "<ul class='second-level'>";
    foreach($node->getChildNodes() as $nodeSecondLevel){
        echo "<li>";
        echo $nodeSecondLevel->getWikiPage()->getTitle();
        echo "</li>";
    }   
    echo "</ul>";
    
    echo "</li>";

}
echo "</ul>";
```

Result:

```html
<h1>Table of content:</h1>
<ul class="first-level">
    <li>
        Instruments
        <ul class="second-level">
            <li>Piano</li>
            <li>Guitar</li>
        </ul>
    </li>
    <li>
        Chordsheets
    </li>
    <li>
        Groups
        <ul class="second-level">
            <li>Worship-Teams</li>
            <li>Service-Teams</li>
        </ul>
    </li>
</ul>
```

## Support / Contribute

Please feel free to Support or Contribute this project.

### CTLog - Logging Request

The CTLog provides a facade to log Informations. By default it logs all important infos, warnings and errors in the
log-file: `churchtools-api.log`. The creation of a logfile can be enabled and disabled with the method:

```php
use CTApi\CTLog;

CTLog::enableFileLog( false ); //disable logfile
CTLog::enableFileLog(); // enable logfile
```

By default, all Error, Critical, Alert and Emergency logs will be displayed in the console. If you want to show further
log-levels on the console you can use the CTConfig-Debug Option or set it direct in the CTLog facade:

```php
CTConfig::enableDebug();

//or use CTLog facade

CTLog::setConsoleLogLevelDebug();
CTLog::enableConsoleLog();
```

To log a message, use the getLog-method:

```php
use CTApi\CTLog;

CTLog::getLog()->debug("Hello World!");
CTLog::getLog()->error("Error accourd here!");
```

Further information on [CTLog-Page](/docs/out/CTLog.md):

### Error-Handling
The API-Wrapper provides custom exceptions. More on this page: [Error-Handling](/docs/out/ErrorHandling.md)

### Doc-Generator
The Doc-Generator processes all Doc-Files and executes the PHP-Code examples to ensure that they are valid. More on this page: [Doc-Generator](/docs/Docs.md)

## License

This project is licensed under MIT-License feel free to use it or to contribute.