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

foreach($personArray as $person){
    echo "- ".$person->getLastName();
}
```

**`get` and `set`-methods**

The attributes of a model can be used accessed with getters and setter.

```php
$person->getLastName();
$person->setLastName("Joe");
```

**`request`-methods**

Any `requestXYZ`-method returns a RequestBuilder and allow you to access the [Requests](Requests.md) methods and type:

```php 
$agenda = $event->requestAgenda()->get();

//Not implemented yet, but soon it will be:
$responsiblePerson = $eventAgenda->requestSongs()
                        ->where('practice', true)
                        ->orderBy('key')
                        ->get();

```
