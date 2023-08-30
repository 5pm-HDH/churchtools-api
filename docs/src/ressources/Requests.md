# Requests

All Request are build similar and share the same methods to request the data from churchtools. The first part describes
the common methods to be used. More specific information to the different Request-Apis are listed in
the [Details](#details) section.

## Use Requests

**Get all data**

```php
use CTApi\Models\Groups\Person\PersonRequest;


$allPersons = PersonRequest::all();
```

**Manual pagination**

Usually the client will return all matching records at once. But this is not
always desired. Instead you may want to load the results in smaller chunks. This
is called *pagination*.

For example if you like to get only the first 3 events of ChurchTools:

{{ \CTApi\Test\Unit\Docs\PaginationTest.testCollectSinglePage }}

This is possible for the other APIs like event or group, too.

Iterating over all records is quite easy.

{{ \CTApi\Test\Unit\Docs\PaginationTest.testIteratePages }}

If you want to set the Pagination Page-Size for all Requests you can use the CTConfig.

```php
use CTApi\CTConfig;

CTConfig::setPaginationPageSize(400);
```

**Get single record**

The `find`-method returns the Model. If there is no record with the given id, it will return null. The `findOrFail`
-method throw an `CTModelException` if no record with the given in id could be found.

```php
use CTApi\Models\Groups\Person\PersonRequest;

$joe = PersonRequest::find(21);

try{
    $joe = PersonRequest::findOrFail(21);
}catch(CTModelException $exception){
    // handle exception
}
```

**Where filter**

The `where`-method allows filtering and set custom filter criteria to the request. Where-clauses can also be
concatenated for more complex filtering. All available filter-criteria are described in the [detail-section](#details)

```php
use CTApi\Models\Groups\Person\PersonRequest;

$teenager = PersonRequest::where('birthday_before', '2007-01-01')
                    ->where('birthday_after', '2003-01-01')
                    ->get();

```

**OrderBy - Sort data**

Sort the data with the `orderBy`-method. The first parameter defines the key to be sorted. The second parameter defines
the sort direction (ascending or descending).

The second example first selects three persons, then sort them by their birthday and secondly by their sex.

```php
use CTApi\Models\Groups\Person\PersonRequest;

$sortedPerson = PersonRequest::orderBy('birthday')->get();

$sortedEvents = PersonRequest::where('ids', [29, 42, 92])
                    ->orderBy('birthday')
                    ->orderBy('sexId')
                    ->get();
```

**Get-Method**

The `get`-method executes the created query and retrieved the data. This method must be the last method to be called on
a created Request. In this example we get the two persons with the ids 219 and 318.

```php
use CTApi\Models\Groups\Person\PersonRequest;

$twoPersons = PersonRequest::where('ids', [219, 318])->get();
```

## Details

### PersonRequest

**Where filter criteria:**

| Criteria | Value | Description |
| --- | --- | --- |
| ids | int-array | select only records with given in id's |
| status_ids | int-array | select only records with given status_ids's |
| campus_ids | int-array | select only records of the given in campus_id's |
| birthday_before | date-string in YYYY-MM-DD format | filter persons with birthday before given in date |
| birthday_after | date-string in YYYY-MM-DD format | filter persons with birthday after given in date |
| is_archived | boolean | show only archived people |

### EventRequest

**Where filter criteria:**

| Criteria | Value | Description |
| --- | --- | --- |
| from | date-string (YYYY-MM-DD) | select events beginning with date |
| to | date-string (YYYY-MM-DD) | select events ending with date |

### SongRequest

**Where filter criteria:**

| Criteria | Value | Description |
| --- | --- | --- |
| ids | int-array | select only records with given in id's |
| song_category_ids | int-array | select only records with given category id's |
| practice | boolean | filter by field shouldPractice |
| key_of_arrangement | string | Filter by arrangement key. (Song + all Arrangements are returned, if one arrangement fulfills the filter) |