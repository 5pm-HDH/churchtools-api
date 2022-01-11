# Models

All Models are build similar and share the same structure of methods.

## Use Models

**Create Models from data**

Create a single model filled with data:

```php
use CTApi\Models\Person;

$data = [
    "id" => 21,
    "firstName" => "Joe",
    "lastName" => "Kling",
    //...
];

$person = Person::createModelFromData($data);

```

Create a collection of models filled with data:

```php
use CTApi\Models\Person;

$dataPersons = [
    ["id" => 21, "firstName" => "Joe", "lastName" => "Kling", /*...*/],
    ["id" => 22, "firstName" => "Dieter", "lastName" => "Maier", /*...*/]    
];

$personArray = Person::createModelsFromArray($dataPersons);

$lastNames = "";
foreach($personArray as $person){
    $lastNames .= $person->getLastName() . ", ";
}
echo ($lastNames);
// OUTPUT: Kling, Maier, 

```

**`get` and `set`-methods**

The attributes of a model can be used accessed with getters and setter.

```php
use CTApi\Models\Person;

$person = new Person();

$person->getLastName();
$person->setLastName("Joe");

```

**`request`-method (one-to-one - singular)**

Any `requestXYZ`-method that requests a single model, will request all information from the api and returns the model
directly:

```php
$event = \CTApi\Models\Event::createModelFromData(['id' => 21]);

$agenda = $event->requestAgenda();

echo ("Event Agenda: " . $agenda->getName());
// OUTPUT: Event Agenda: Event Agenda

```

**`request`-method (one-to-many - plural)**

Any `requestXYZ`-method that returns multiple models, returns a RequestBuilder and allow you to access
the [Requests](Requests.md) methods and type:

```php
$eventAgenda = \CTApi\Models\EventAgenda::createModelFromData(['id' => 21]);

$songs = $eventAgenda->requestSongs()
                        ->where('practice', true)
                        ->orderBy('key')
                        ->get();

```

A "one-to-many" relation can be easily identified by check if the `requestXYZ`-method ends with an "s" (e.q.:
requestSong**s**, requestFile**s**, ...).
