# PersonAPI
```

use CTApi\Requests\PersonRequest;

// logged in user
$myself = PersonRequest::whoami();

echo "Logged in Person: " . $myself->getFirstName() . " " . $myself->getLastName());
// OUTPUT: Logged in Person: Matthew Evangelist

// Get specific Person
$personA = PersonRequest::find(21);     // returns "null" if id is invalid
$personB = PersonRequest::findOrFail(22); // throws exception if id is invalid

// request all users
$allPersons = PersonRequest::all();
foreach($allPersons as $person){
    echo "<li>".$person->getFirstName()."</li>");
// OUTPUT: <li>Matthew</li>
}

// filter user
$teenager = PersonRequest::where('birthday_before', '2007-01-01')
->where('birthday_after', '2003-01-01')
->orderBy('birthday')
->get();

// Request Event of Person
$personA = PersonRequest::whoami();
$events = $personA->requestEvents()->get();


```
