# DBFields

## Retrieve all DB-fields:

{{ \CTApi\Test\Unit\Docs\DBFieldRequestTest.testGetAllDBFields }}

## Retrieve single DB-field:

{{ \CTApi\Test\Unit\Docs\DBFieldRequestTest.testGetDBField }}

## Read DBFields in Model

To access the custom DBFields, utilize the `getDBFieldData()` method. This will provide an array where the column name of the DBField serves as the key and holds the corresponding value. Alternatively, you can use the `requestDBFields()->get()` method to retrieve a list of DBFieldValueContainers. Each container includes the key, value, and additional details from the DBField model such as name, content-type, and other relevant information. Example for **GroupInformation**:

{{ \CTApi\Test\Unit\Docs\DBFieldRequestTest.testReadGroupDBField }}

DBFields are also existing for **Persons**:

{{ \CTApi\Test\Unit\Docs\DBFieldRequestTest.testDBFieldsPerson }}

Developer Tip: To associate DBFields with a model, you can easily accomplish this by implementing the HasDBFields trait.