# Churchtools (CT) API-Client

## Configuration

Before you can start to request data from the API you need to configure the CT-Client with the `Config`-interface:
```php
use \CTApi\CTConfig;

    //set the url of your churchtools application api
CTConfig::setApiUrl("https://example.church.tools/api");

    //authenticates the application and retrieve the api-key
CTConfig::authWithCredentials(
    "example.email@gmx.de",
    "myPassword1234"
);

    // if everything works fine, the $apiKey wont be null anymore
$apiKey = CTConfig::getApiKey();
```

## Retrieve persons
To retrieve data from the api you can use the Requests-Interfaces. They will provide filter options ("where"-clause) and concatenation of filtering through the fluent api.
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