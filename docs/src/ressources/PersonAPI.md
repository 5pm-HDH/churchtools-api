# PersonAPI

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testExampleCode }}

## Request Tags from Person

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testRequestTags }}

## Retrieve Birthdays

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testBirthdayRequest }}

## Create person

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testCreatePerson }}

Sometimes it will happen that you have to add a person with the same name
as an existing one. ChurchTools will respond with an error to prevent you from
adding duplicates accidently.

Therefore you can add the `force` parameter and set it to `true`.

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testCreatePersonWithEqualName }}

This will make ChurchTools to insert the record, even if there is a second John Doe.

## Update a person's data

Use the setters of the person model to modify its data and utilize the
`PersonRequest::update(...)` method to send the new data to ChurchTools.

Follow this example:

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testUpdatePerson }}

This will send all data of the person to the API and persists them.

If you know that only a specific set of attributes is changed, you can limit the
data sent to the API, by adding a whitelist of attributes.

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testUpdatePersonSingleAttrbute }}

Now, only the e-mail will be sent to the API. This may be used to reduce
unnecessary traffic if you are going to do some bulk updates.

The following attributes can be updated:

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testUpdatePersonModifiableAttributes }}

## Delete person

Delete person via PersonRequest:

{{ \CTApi\Test\Unit\Docs\PersonRequestTest.testDeletePerson }}