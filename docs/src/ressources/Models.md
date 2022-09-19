# Models

All Models are build similar and share the same structure of methods.

## Use Models

**Create Models from data**

Create a single model filled with data:

{{ \Tests\Unit\Docs\ModelTest.testCreateModelFromData }}

Create a collection of models filled with data:

{{ \Tests\Unit\Docs\ModelTest.testCreateModelsFromArray }}

**Convert Model to data**

Convert a model with the `toData`-method (FillWithData-Trait):

{{ \Tests\Unit\Docs\ModelTest.testConvertModelToData }}


**`get` and `set`-methods**

The attributes of a model can be used accessed with getters and setter.

{{ \Tests\Unit\Docs\ModelTest.testGetterAndSetter }}

The model id can be retrieved with the `getId` getter. There is also a null-safe getter (`getIdOrFail`) and a integer casted getter (`getIdAsInteger`):

{{ \Tests\Unit\Docs\ModelTest.testGetId }}

**`request`-method (one-to-one - singular)**

Any `requestXYZ`-method that requests a single model, will request all information from the api and returns the model
directly:

{{ \Tests\Unit\Docs\ModelEventTest.testRequestMethod }}

**`request`-method (one-to-many - plural)**

Any `requestXYZ`-method that returns multiple models, returns a RequestBuilder and allow you to access
the [Requests](Requests.md) methods and type:

{{ \Tests\Unit\Docs\ModelEventTest.testRequestMethodPlural }}

A "one-to-many" relation can be easily identified by check if the `requestXYZ`-method ends with an "s" (e.q.:
requestSong**s**, requestFile**s**, ...).
