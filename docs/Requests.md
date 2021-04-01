# Requests

All Request are build similar and share the same methods to request the data from churchtools. The first part describes the common methods to be used. More specific information to the different Request-Apis are listed in the [Details](#details) section.
## Use Requests-Api

**Get all data**

```php
$allPersons = PersonRequest::all();
```

**Get single record**

The `find`-method returns the Model. If there is no record with the given id, it will return null. The `findOrFail`-method throw an `CTModelException` if no record with the given in id could be found.

```php
$joe = PersonRequest::find(291);

try{
    $joe = PersonRequest::findOrFail(291);
}catch(CTModelException $exception){
    // handle exception
}
```

**Where filter** 

The `where`-method allows filtering and set custom filter criteria to the request. Where-clauses can also be concatenated for more complex filtering. All available filter-criteria are described in the [detail-section](#details)

```php
$teenager = PersonRequest::where('birthday_before', '2007-01-01')
                    ->where('birthday_after', '2003-01-01')
                    ->get();

```

**Get-Method** 

The `get`-method executes the created query and retrieved the data. This method must be the last method to be called on a created Request. In this example we get the two persons with the ids 219 and 318.

```php
$twoPersons = PersonRequest::where('ids', [219, 318])->get();
```

## Details

* [PersonRequest](#personrequest)
* [EventRequest](#eventrequest)


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