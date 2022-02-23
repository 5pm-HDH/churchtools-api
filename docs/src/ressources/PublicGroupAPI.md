# Public-Group API

Load Data of Group Homepage with Hash-String. This route is public, so no authentication of the CTConfig is necessary.

{{ \Tests\Unit\Docs\PublicGroupRequestTest.testExampleCodePublicGroupInit }}

The PublicGroup-Model is a Subtype of Group. So all methods of Group will be available in
PublicGroup: [GroupAPI](GroupAPI.md)

Further the PublicGroup-Model contains the following Methods:

{{ \Tests\Unit\Docs\PublicGroupRequestTest.testExampleCodePublicGroup }}

For More-Informations on the Attributes have a look at the SourceCode:

- [Group](../src/Models/Group.php)
- [PublicGroup](../src/Models/PublicGroup.php)
- [GroupInformation](../src/Models/GroupInformation.php)
- [TargetGroup](../src/Models/TargetGroup.php)
- [GroupCategory](../src/Models/GroupCategory.php)
- [GroupPlace](../src/Models/GroupPlace.php)
