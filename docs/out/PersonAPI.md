# PersonAPI

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

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
        $files = $personA->requestAvatar()?->get() ?? [];
        $avatar = end($files);

        var_dump( $avatar->getName());
        // Output: "avatar-1.png"

        //$personA->requestAvatar()->upload("new-avatar.png");

```

## Person Properties

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

        $person = PersonRequest::findOrFail(12);

        var_dump( $person->getId());
        // Output: 12

        var_dump( $person->getGuid());
        // Output: "BF4AC3A9-2C43-46A5-8AA4-D39D795C26B0"

        var_dump( $person->getSecurityLevelForPerson());
        // Output: 99999

        var_dump( $person->getEditSecurityLevelForPerson());
        // Output: 99999

        var_dump( $person->getTitle());
        // Output: ""

        var_dump( $person->getFirstName());
        // Output: "David"

        var_dump( $person->getLastName());
        // Output: "König"

        var_dump( $person->getNickname());
        // Output: "Dave"

        var_dump( $person->getJob());
        // Output: "Worship-Pastor"

        var_dump( $person->getStreet());
        // Output: null

        var_dump( $person->getAddressAddition());
        // Output: null

        var_dump( $person->getZip());
        // Output: null

        var_dump( $person->getCity());
        // Output: null

        var_dump( $person->getCountry());
        // Output: null

        var_dump( $person->getLatitude());
        // Output: null

        var_dump( $person->getLongitude());
        // Output: null

        var_dump( $person->getLatitudeLoose());
        // Output: null

        var_dump( $person->getLongitudeLoose());
        // Output: null

        var_dump( $person->getPhonePrivate());
        // Output: null

        var_dump( $person->getPhoneWork());
        // Output: null

        var_dump( $person->getMobile());
        // Output: null

        var_dump( $person->getFax());
        // Output: null

        var_dump( $person->getBirthName());
        // Output: "Doe"

        var_dump( $person->getBirthday());
        // Output: "1992-06-02"

        var_dump( $person->getBirthdayAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "1992-06-02 00:00:00"

        var_dump( $person->getBirthplace());
        // Output: "Bethlehem"

        var_dump( $person->getImageUrl());
        // Output: "https://5pm.church.tools/images/875/2bc0d52971857aebbec193783f8b92d7d16a7342ea9beb220386b2c5872865bc"

        var_dump( $person->getFamilyImageUrl());
        // Output: null

        var_dump( $person->getSexId());
        // Output: 1

        var_dump( $person->getEmail());
        // Output: "DAVID.5PM@gmail.com"


        var_dump( $person->getEmails()[0]["email"]);
        // Output: "DAVID.5PM@gmail.com"

        var_dump( $person->getEmails()[0]["isDefault"]);
        // Output: true

        var_dump( $person->getEmails()[0]["contactLabelId"]);
        // Output: 2


        var_dump( $person->getCmsUserId());
        // Output: "dkönig"

        var_dump( $person->getOptigemId());
        // Output: null

        var_dump( $person->getPrivacyPolicyAgreement()["date"]);
        // Output: "2023-05-03"

        var_dump( $person->getPrivacyPolicyAgreement()["typeId"]);
        // Output: 3

        var_dump( $person->getPrivacyPolicyAgreement()["whoId"]);
        // Output: 1

        var_dump( $person->getPrivacyPolicyAgreementDate());
        // Output: "2023-05-03"

        var_dump( $person->getPrivacyPolicyAgreementTypeId());
        // Output: 3

        var_dump( $person->getPrivacyPolicyAgreementWhoId());
        // Output: 1

        var_dump( $person->getNationalityId());
        // Output: 0

        var_dump( $person->getFamilyStatusId());
        // Output: 0

        var_dump( $person->getWeddingDate());
        // Output: "2023-04-02"

        var_dump( $person->getWeddingDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2023-04-02 00:00:00"

        var_dump( $person->getCampusId());
        // Output: null

        var_dump( $person->getStatusId());
        // Output: null

        var_dump( $person->getDepartmentIds());
        // Output: [1]

        var_dump( $person->getFirstContact());
        // Output: "2023-05-03"

        var_dump( $person->getFirstContactAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2023-05-03 00:00:00"

        var_dump( $person->getDateOfBelonging());
        // Output: null

        var_dump( $person->getDateOfBelongingAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: null

        var_dump( $person->getDateOfEntry());
        // Output: null

        var_dump( $person->getDateOfEntryAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: null

        var_dump( $person->getDateOfResign());
        // Output: null

        var_dump( $person->getDateOfResignAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: null

        var_dump( $person->getDateOfBaptism());
        // Output: null

        var_dump( $person->getDateOfBaptismAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: null

        var_dump( $person->getPlaceOfBaptism());
        // Output: null

        var_dump( $person->getBaptisedBy());
        // Output: null

        var_dump( $person->getReferredBy());
        // Output: null

        var_dump( $person->getReferredTo());
        // Output: null

        var_dump( $person->getGrowPathId());
        // Output: null

        var_dump( $person->getCanChat());
        // Output: null

        var_dump( $person->getInvitationStatus());
        // Output: "accepted"

        var_dump( $person->getChatActive());
        // Output: true

        var_dump( $person->getIsArchived());
        // Output: null


```

## Request Tags from Person

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

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
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

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


        var_dump( $lastBirthdayPerson->getDate());
        // Output: "1997-03-01"

        var_dump( $lastBirthdayPerson->getAnniversaryInitialDate());
        // Output: "1997-03-01"

        var_dump( $lastBirthdayPerson->getAnniversary());
        // Output: "2022-03-01"


        var_dump( $lastBirthdayPerson->getDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "1997-03-01 00:00:00"

        var_dump( $lastBirthdayPerson->getAnniversaryInitialDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "1997-03-01 00:00:00"

        var_dump( $lastBirthdayPerson->getAnniversaryAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2022-03-01 00:00:00"



        var_dump( $lastBirthdayPerson->getAge());
        // Output: "25"


```

## Create person

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

        $newPerson = new Person();
        $newPerson->setFirstName("John")
            ->setLastName("Doe")
            ->setBirthName("Smith");
        //add further attributes

        PersonRequest::create($newPerson);

```

Sometimes it will happen that you have to add a person with the same name
as an existing one. ChurchTools will respond with an error to prevent you from
adding duplicates accidently.

Therefore you can add the `force` parameter and set it to `true`.

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

        $newPerson = new Person();
        $newPerson->setFirstName("John")
            ->setLastName("Doe")
            ->setBirthday("1970-01-01");
        //add further attributes

        PersonRequest::create($newPerson, force: true);

```

This will make ChurchTools to insert the record, even if there is a second John Doe.

## Update a person's data

Use the setters of the person model to modify its data and utilize the
`PersonRequest::update(...)` method to send the new data to ChurchTools.

Follow this example:

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

        $person = PersonRequest::findOrFail(21);
        $person->setEmail('new-mail@example.com');

        PersonRequest::update($person);

```

This will send all data of the person to the API and persists them.

If you know that only a specific set of attributes is changed, you can limit the
data sent to the API, by adding a whitelist of attributes.

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

        $person = PersonRequest::findOrFail(21);
        $person->setEmail('new-mail@example.com');
        $person->setJob('This should not be persisted!');

        PersonRequest::update($person, ['email']);

```

Now, only the e-mail will be sent to the API. This may be used to reduce
unnecessary traffic if you are going to do some bulk updates.

The following attributes can be updated:

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

        $person = PersonRequest::findOrFail(21);

        // Attributes that can be updated in ChurchTools-API
        $listOfModifiableAttributes = implode("; ", $person->getModifiableAttributes());
        var_dump( $listOfModifiableAttributes);
        // Output: "addressAddition; birthday; birthName; birthplace; campusId; city; country; departmentIds; email; fax; firstName; job; lastName; mobile; nickname; phonePrivate; phoneWork; sexId; statusId; street; zip"


```

## Delete person

Delete person via PersonRequest:

```php
        use CTApi\Models\Groups\Person\Person;
        use CTApi\Models\Groups\Person\PersonRequest;

        $person = PersonRequest::findOrFail(21);

        // delete person on churchtools
        PersonRequest::delete($person);

```