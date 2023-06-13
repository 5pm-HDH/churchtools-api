# ChurchTools-API Client

![static-code-analysis workflow](https://github.com/5pm-HDH/churchtools-api/actions/workflows/static-code-analysis.yml/badge.svg)

![unit-test workflow](https://github.com/5pm-HDH/churchtools-api/actions/workflows/unit-tests.yml/badge.svg)

![integarion-test workflow](https://github.com/5pm-HDH/churchtools-api/actions/workflows/integration-tests.yml/badge.svg)

The ChurchTools-API Client is a PHP-based wrapper for the ChurchTools API and has been tested with ChurchTools
version <version>3.99.0</version>.

## Installation

Go to the project-root and install ChurchTools-API via [composer](https://getcomposer.org/):

```
composer require 5pm-hdh/churchtools-api
```

Load all dependency packages into the PHP project using the following code:

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

// Multi-factor authentication:
CTConfig::authWithCredentials(
    "example.email@gmx.de",
    "myPassword1234",
    "291521"
);
```

For more information visit the [CTConfig documentation](/docs/out/CTConfig.md)
From now on all features of the ChurchTools-API are available.

### Requests and Models

The whole ChurchTools-API client is build on top of the Requests and Models. [Requests](/docs/out/Requests.md) provide
an interface to specify your api call by adding filtering, pagination and sorting. [Models](/docs/out/Models.md)
represent the data, that the Requests retrieve. More informations can be found in the documentation.

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
* [Search-API](/docs/out/SearchAPI.md)
* [DB-Fields](/docs/out/DBFields.md)

The following brief examples demonstrate the capabilities of the ChurchTools-API client and provide a general overview
of its potential uses:

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

We welcome your support and contributions to this project.

### CTLog - Logging Request

The CTLog provides a facade to log Informations. By default it logs all important infos, warnings and errors in the
log-file: `churchtools-api.log`. The creation of a logfile can be enabled and disabled with the method:

```php
use CTApi\CTLog;

CTLog::enableFileLog( false ); //disable logfile
CTLog::enableFileLog(); // enable logfile
```

By default, the console will display all logs of Error, Critical, Alert, and Emergency levels. If you wish to display
additional log levels on the console, you may use the CTConfig-Debug option or set it directly in the CTLog facade:

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

### Unit- and Integration-Tests

To access the unit tests, navigate to the "tests/unit" directory. You may use the standard PHPUnit\Framework\TestCase to
test small sections of code, or use TestCaseHttpMocked to simulate an HTTP request.

For integration tests, requests are sent directly to a ChurchTools instance. The "integration-test-data.json" file
contains all available test data scenarios. All integration tests are automatically executed via Github Actions.

### Doc-Generator

The Doc-Generator parses all documentation files and runs the PHP code examples to verify their validity. For additional
information, please refer to this page: [Doc-Generator](/docs/Docs.md)

## License

This project is licensed under MIT-License feel free to use it or to contribute.