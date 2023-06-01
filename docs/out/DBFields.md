# DBFields

## Retrieve all DB-fields:

```php
        use Requests\DBFieldRequest;

        $dbFields = DBFieldRequest::all();
        $dbField5pmName = $dbFields[0];

        var_dump( $dbField5pmName->getId());
        // Output: 141

        var_dump( $dbField5pmName->getName());
        // Output: "5pm Bezeichnung"

        var_dump( $dbField5pmName->getShorty());
        // Output: "5pm_name"

        var_dump( $dbField5pmName->getColumn());
        // Output: "5pm_name"

        var_dump( $dbField5pmName->getLength());
        // Output: 220

        var_dump( $dbField5pmName->getFieldCategory()?->getName());
        // Output: "group"

        var_dump( $dbField5pmName->getFieldCategory()?->getInternCode());
        // Output: "f_group"

        var_dump( $dbField5pmName->getFieldCategory()?->getTable());
        // Output: "cdb_gruppe"

        var_dump( $dbField5pmName->getFieldCategory()?->getId());
        // Output: 4

        var_dump( $dbField5pmName->getFieldType()?->getName());
        // Output: "Textfeld"

        var_dump( $dbField5pmName->getFieldType()?->getInternCode());
        // Output: "text"

        var_dump( $dbField5pmName->getFieldType()?->getId());
        // Output: 1

        var_dump( $dbField5pmName->getIsActive());
        // Output: true

        var_dump( $dbField5pmName->getIsNewPersonField());
        // Output: false

        var_dump( $dbField5pmName->getLineEnding());
        // Output: ""

        var_dump( $dbField5pmName->getSecurityLevel());
        // Output: 1

        var_dump( $dbField5pmName->getSortKey());
        // Output: 0

        var_dump( $dbField5pmName->getDeleteOnArchive());
        // Output: false

        var_dump( $dbField5pmName->getNullable());
        // Output: true

        var_dump( $dbField5pmName->getHideInFrontend());
        // Output: false

        var_dump( $dbField5pmName->getNotConfigurable());
        // Output: false

        var_dump( $dbField5pmName->getIsBasicInfo());
        // Output: false


```

## Retrieve single DB-field:

```php
        use Requests\DBFieldRequest;

        $dbField5pmName = DBFieldRequest::find(141);
        // or
        $dbField5pmName = DBFieldRequest::findOrFail(141);

        var_dump( $dbField5pmName->getId());
        // Output: 141

        var_dump( $dbField5pmName->getName());
        // Output: "5pm Bezeichnung"

        // ...

```
