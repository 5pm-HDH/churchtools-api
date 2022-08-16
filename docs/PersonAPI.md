# PersonAPI

```php
        use CTApi\Requests\PersonRequest;

        // logged in user
        $myself = PersonRequest::whoami();

        var_dump( "Logged in Person: " . $myself->getFirstName() . " " . $myself->getLastName());
        // Output: "Logged in Person: Matthew Evangelist"


        // Get specific Person
        $personA = PersonRequest::find(21);     // returns "null" if id is invalid
        $personB = PersonRequest::findOrFail(22); // throws exception if id is invalid

        // request all users
        $allPersons = PersonRequest::all();
        $personList = "";
        foreach ($allPersons as $person) {
            $personList .= $person->getFirstName() . " / ";
        }
        var_dump( $personList);
        // Output: "Matthew / Mark / Luke / John / "


        // filter user
        $teenager = PersonRequest::where('birthday_before', '2007-01-01')
            ->where('birthday_after', '2003-01-01')
            ->orderBy('birthday')
            ->get();

        // Request Event of Person
        $personA = PersonRequest::whoami();
        $events = $personA->requestEvents()?->get();

```

## Update a person's data

Use the setters of the person model to modify its data and utilize the
`PersonRequest::update(...)` method to send the new data to ChurchTools.

Follow this example:

```php
use CTApi\Requests\PersonRequest;

$person = PersonRequest::findOrFail(21);
$person->setEmail('new-mail@example.com');

PersonRequest::update($person);
```

This will send all data of the person to the API and persists them.

If you know that only a specific set of attributes is changed, you can limit the
data sent to the API, by adding a whitelist of attributes.

```php
$person->setEmail('new-mail@example.com');
$person->setJob('This should not be persisted!');

PersonRequest::update($person, ['email']);
```

Now, only the e-mail will be sent to the API. This may be used to reduce
unnecessary traffic if you are going to do some bulk updates.