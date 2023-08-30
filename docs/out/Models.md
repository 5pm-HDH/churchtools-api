# Models

All Models are build similar and share the same structure of methods.

## Use Models

**Create Models from data**

Create a single model filled with data:

```php
        use CTApi\Models\Groups\Person\Person;

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
        use CTApi\Models\Groups\Person\Person;

        $dataPersons = [
            ["id" => 21, "firstName" => "Joe", "lastName" => "Kling", /*...*/],
            ["id" => 22, "firstName" => "Dieter", "lastName" => "Maier", /*...*/]
        ];

        $personArray = Person::createModelsFromArray($dataPersons);

        $lastNames = "";
        foreach ($personArray as $person) {
            $lastNames .= $person->getLastName() . "/ ";
        }
        var_dump( $lastNames);
        // Output: "Kling/ Maier/ "


```

**Convert Model to data**

Convert a model with the `toData`-method (FillWithData-Trait):

```php
        use CTApi\Models\Groups\Person\Person;

        $data = $this->person->toData();

        var_dump( $data["firstName"]);
        // Output: "John"

        var_dump( $data["meta"]["createdPerson"]["firstName"]);
        // Output: "Simon"


```


**`get` and `set`-methods**

The attributes of a model can be used accessed with getters and setter.

```php
        use CTApi\Models\Groups\Person\Person;

        $person = new Person();

        $person->getLastName();
        $person->setLastName("Joe");

```

The model id can be retrieved with the `getId` getter. There is also a null-safe getter (`getIdOrFail`) and a integer casted getter (`getIdAsInteger`):

```php
        use CTApi\Models\Groups\Person\Person;

        // can be null:
        var_dump( $this->person->getId());
        // Output: "21"


        // throws CTModelException if id is null:
        var_dump( $this->person->getIdOrFail());
        // Output: "21"


        // return int or throws CTModelException:
        var_dump( $this->person->getIdAsInteger());
        // Output: 21


```

**`request`-method (one-to-one - singular)**

Any `requestXYZ`-method that requests a single model, will request all information from the api and returns the model
directly:

```php
        use CTApi\Models\Events\Event\Event;
        use CTApi\Models\Events\Event\EventAgenda;

        $event = Event::createModelFromData(['id' => 21]);
        $agenda = $event->requestAgenda();

        var_dump( $agenda->getName());
        // Output: "Sunday Service Agenda"


```

**`request`-method (one-to-many - plural)**

Any `requestXYZ`-method that returns multiple models, returns a RequestBuilder and allow you to access
the [Requests](Requests.md) methods and type:

```php
        use CTApi\Models\Events\Event\Event;
        use CTApi\Models\Events\Event\EventAgenda;

        $eventAgenda = EventAgenda::createModelFromData(['id' => 21]);

        $songs = $eventAgenda->requestSongs()
            ->where('practice', true)
            ->orderBy('key')
            ->get();

```

A "one-to-many" relation can be easily identified by check if the `requestXYZ`-method ends with an "s" (e.q.:
requestSong**s**, requestFile**s**, ...).
