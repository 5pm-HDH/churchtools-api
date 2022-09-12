# PersonAPI

{{ \Tests\Unit\Docs\PersonRequestTest.testExampleCode }}

## Request Tags from Person

{{ \Tests\Unit\Docs\PersonRequestTest.testRequestTags }}

## Retrieve Birthdays

{{ \Tests\Unit\Docs\PersonRequestTest.testBirthdayRequest }}

## Create person

{{ \Tests\Unit\Docs\PersonRequestTest.testCreatePerson }}

## Update a person's data

Use the setters of the person model to modify its data and utilize the
`PersonRequest::update(...)` method to send the new data to ChurchTools.

Follow this example:

{{ \Tests\Unit\Docs\PersonRequestTest.testUpdatePerson }}

This will send all data of the person to the API and persists them.

If you know that only a specific set of attributes is changed, you can limit the
data sent to the API, by adding a whitelist of attributes.

{{ \Tests\Unit\Docs\PersonRequestTest.testUpdatePersonSingleAttrbute }}

Now, only the e-mail will be sent to the API. This may be used to reduce
unnecessary traffic if you are going to do some bulk updates.

The following attributes can be updated:

{{ \Tests\Unit\Docs\PersonRequestTest.testUpdatePersonModifiableAttributes }}

## Delete person

Delete person via PersonRequest:

{{ \Tests\Unit\Docs\PersonRequestTest.testDeletePerson }}