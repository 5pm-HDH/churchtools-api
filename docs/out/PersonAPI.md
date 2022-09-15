# PersonAPI

```php
        use CTApi\Models\Person;
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

        // Update Avatar: See File-API
        $files = $personA->requestAvatar()->get();
        $avatar = end($files);

        var_dump( $avatar->getName());
        // Output: "avatar-1.png"

        //$personA->requestAvatar()->upload("new-avatar.png");

```

## Request Tags from Person

```php
        use CTApi\Models\Person;
        use CTApi\Requests\PersonRequest;

        $person = (new Person())->setId("21");

        $tags = $person->requestTags()?->get();

        if ($tags == null) {
            $tags = [];
        }

        $musicDirectorTag = null;
        foreach ($tags as $tag) {
            if ($tag->getName() == "Music Director") {
                $musicDirectorTag = $tag;
            }
        }
        // Tag-Data
        var_dump( $musicDirectorTag?->getId());
        // Output: 5

        var_dump( $musicDirectorTag?->getName());
        // Output: "Music Director"

        var_dump( $musicDirectorTag?->getCount());
        // Output: 9


        // Meta-Data
        var_dump( $musicDirectorTag?->getModifiedAt());
        // Output: "2021-05-19T06:21:02Z"

        var_dump( $musicDirectorTag?->getModifiedBy());
        // Output: 21

        var_dump( $musicDirectorTag?->requestModifier()?->getFirstName());
        // Output: "Matthew"


```

## Retrieve Birthdays

```php
        use CTApi\Models\Person;
        use CTApi\Requests\PersonRequest;

        $birthdayPersons = PersonRequest::birthdays()
            ->where("start_date", "2022-01-01")
            ->where("end_date", "2022-12-31")
            ->where("my_groups", true)
            ->get();

        $lastBirthdayPerson = end($birthdayPersons);

        var_dump( $lastBirthdayPerson->getPerson()?->getId());
        // Output: "21"

        var_dump( $lastBirthdayPerson->getPerson()?->getFirstName());
        // Output: "John"

        var_dump( $lastBirthdayPerson->getPerson()?->getLastName());
        // Output: "Snow"


        var_dump( $lastBirthdayPerson->getAnniversaryInitialDate());
        // Output: "1997-03-01"

        var_dump( $lastBirthdayPerson->getAnniversary());
        // Output: "2022-03-01"

        var_dump( $lastBirthdayPerson->getAge());
        // Output: "25"


```

## Create person

```php
        use CTApi\Models\Person;
        use CTApi\Requests\PersonRequest;

        $newPerson = new Person();
        $newPerson->setFirstName("John")
            ->setLastName("Doe")
            ->setBirthName("Smith");
        //add further attributes

        PersonRequest::create($newPerson);

```

## Update a person's data

Use the setters of the person model to modify its data and utilize the
`PersonRequest::update(...)` method to send the new data to ChurchTools.

Follow this example:

```php
        use CTApi\Models\Person;
        use CTApi\Requests\PersonRequest;

        $person = PersonRequest::findOrFail(21);
        $person->setEmail('new-mail@example.com');

        PersonRequest::update($person);

```

This will send all data of the person to the API and persists them.

If you know that only a specific set of attributes is changed, you can limit the
data sent to the API, by adding a whitelist of attributes.

```php
        use CTApi\Models\Person;
        use CTApi\Requests\PersonRequest;

        $person = PersonRequest::findOrFail(21);
        $person->setEmail('new-mail@example.com');
        $person->setJob('This should not be persisted!');

        PersonRequest::update($person, ['email']);

```

Now, only the e-mail will be sent to the API. This may be used to reduce
unnecessary traffic if you are going to do some bulk updates.

The following attributes can be updated:

```php
        use CTApi\Models\Person;
        use CTApi\Requests\PersonRequest;

        $person = PersonRequest::findOrFail(21);

        // Attributes that can be updated in ChurchTools-API
        $listOfModifiableAttributes = implode("; ", $person->getModifiableAttributes());
        var_dump( $listOfModifiableAttributes);
        // Output: "addressAddition; birthday; birthName; birthplace; campusId; city; country; departmentIds; email; fax; firstName; job; lastName; mobile; nickname; phonePrivate; phoneWork; sexId; statusId; street; zip"


```

## Delete person

Delete person via PersonRequest:

```php
        use CTApi\Models\Person;
        use CTApi\Requests\PersonRequest;

        $person = PersonRequest::findOrFail(21);

        // delete person on churchtools
        PersonRequest::delete($person);

```