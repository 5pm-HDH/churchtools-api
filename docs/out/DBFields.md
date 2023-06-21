# DBFields

## Retrieve all DB-fields:

```php
        use CTApi\Models\Common\DBField\DBFieldRequest;

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
        use CTApi\Models\Common\DBField\DBFieldRequest;

        $dbField5pmName = DBFieldRequest::find(141);
        // or
        $dbField5pmName = DBFieldRequest::findOrFail(141);

        var_dump( $dbField5pmName->getId());
        // Output: 141

        var_dump( $dbField5pmName->getName());
        // Output: "5pm Bezeichnung"

        // ...

```

## Read DBFields in Model

To access the custom DBFields, utilize the `getDBFieldData()` method. This will provide an array where the column name of the DBField serves as the key and holds the corresponding value. Alternatively, you can use the `requestDBFields()->get()` method to retrieve a list of DBFieldValueContainers. Each container includes the key, value, and additional details from the DBField model such as name, content-type, and other relevant information. Example for **GroupInformation**:

```php
        use CTApi\CTConfig;use CTApi\Models\Groups\Group\GroupRequest;

        CTConfig::enableDebugging();
        $group = GroupRequest::findOrFail(9);
        $groupInformation = $group->getInformation();

        /**
         * Get all DB-Field keys:
         */
        $dbFieldKeys = $groupInformation?->getDBFieldKeys() ?? [];
        $dbFieldKeysList = implode("; ", $dbFieldKeys);

        var_dump( $dbFieldKeysList);
        // Output: "color; 5pm_name"


        /**
         * Get DB-Field data:
         */
        $dbFieldData = "";
        foreach ($groupInformation?->getDBFieldData() ?? [] as $dbFieldKey => $dbFieldValue) {
            $dbFieldData .= $dbFieldKey . "=" . $dbFieldValue . "; ";
        }
        var_dump( $dbFieldData);
        // Output: "color=; 5pm_name=Worship-Team; "


        /**
         * Get DB-Field data with DBModel
         */
        $dbFieldNames = "";

        $dbFieldContainerList = $groupInformation?->requestDBFields()->get();

        foreach ($dbFieldContainerList as $dbFieldValueContainer) {
            // $dbFieldValueContainer is from Type "DBFieldValueContainer"
            $dbFieldKey = $dbFieldValueContainer->getDBFieldKey();
            $dbFieldValue = $dbFieldValueContainer->getDBFieldValue();
            $dbField = $dbFieldValueContainer->getDBField();

            $dbFieldNames .= $dbField->getName() . "; ";
            // see: DBField-Model
        }
        var_dump( $dbFieldNames);
        // Output: "color; 5pm Bezeichnung; "


```

DBFields are also existing for **Persons**:

```php
        use CTApi\Models\Groups\Person\PersonRequest;

        $person = PersonRequest::findOrFail(12);
        $dbFieldContainerList = $person->requestDBFields()->get();
        $dbFieldValueContainer = $dbFieldContainerList[0];

        $key = $dbFieldValueContainer->getDBFieldKey();
        $value = $dbFieldValueContainer->getDBFieldValue();

        var_dump( $key);
        // Output: "5pm_first_contact"

        var_dump( $value);
        // Output: "1629-06-01"


        $dbFieldFirstContact = $dbFieldValueContainer->getDBField();

        var_dump( $dbFieldFirstContact->getId());
        // Output: 142

        var_dump( $dbFieldFirstContact->getName());
        // Output: "Erstkontakt (5pm)"

        var_dump( $dbFieldFirstContact->getShorty());
        // Output: "first_contact"

        var_dump( $dbFieldFirstContact->getColumn());
        // Output: "5pm_first_contact"

        var_dump( $dbFieldFirstContact->getLength());
        // Output: 20



```

Developer Tip: To associate DBFields with a model, you can easily accomplish this by implementing the HasDBFields trait.