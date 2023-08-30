# AbsenceAPI

## Absence-Request
```php
        use CTApi\Models\Events\Absence\Absence;
        use CTApi\Models\Events\Absence\AbsenceRequest;

        $absences = AbsenceRequest::forPerson(118)
            ->where("from_date", "2022-01-01")
            ->where("to_date", "2022-06-01")
            ->get();

        $vaccationAbsence = end($absences);

        var_dump( $vaccationAbsence->getId());
        // Output: "10"

        var_dump( $vaccationAbsence->getComment());
        // Output: "Vacation in the alps"

        var_dump( $vaccationAbsence->getAbsenceReason()?->getId());
        // Output: "2"

        var_dump( $vaccationAbsence->getAbsenceReason()?->getName());
        // Output: "Urlaub"

        var_dump( $vaccationAbsence->getStartDate());
        // Output: "2022-02-23"

        var_dump( $vaccationAbsence->getStartDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2022-02-23 00:00:00"

        var_dump( $vaccationAbsence->getStartTime());
        // Output: null

        var_dump( $vaccationAbsence->getEndDate());
        // Output: "2022-02-25"

        var_dump( $vaccationAbsence->getEndDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2022-02-25 00:00:00"

        var_dump( $vaccationAbsence->getEndTime());
        // Output: null

        var_dump( $vaccationAbsence->getPerson()?->getFirstName());
        // Output: "Matthew"


```

## Create Absence

```php
        use CTApi\Models\Events\Absence\Absence;
        use CTApi\Models\Events\Absence\AbsenceRequest;

        $absence = new Absence();
        $absence->setStartDate("2020-09-13")->setEndDate("2020-09-14");
        $absence->setComment("Meditation in the monastery.");
        $absence->setAbsenceReasonId("2");

        AbsenceRequest::createAbsence(118, $absence);

        var_dump( $absence->getId());
        // Output: "11"

        var_dump( $absence->getComment());
        // Output: "Meditation in the monastery."

        var_dump( $absence->getAbsenceReason()?->getId());
        // Output: "2"

        var_dump( $absence->getAbsenceReason()?->getName());
        // Output: "Urlaub"

        var_dump( $absence->getStartDate());
        // Output: "2020-09-13"

        var_dump( $absence->getStartTime());
        // Output: null

        var_dump( $absence->getEndDate());
        // Output: "2020-09-14"

        var_dump( $absence->getEndTime());
        // Output: null

        var_dump( $absence->getPerson()?->getFirstName());
        // Output: "Matthew"


```

## Update Absence

```php
        use CTApi\Models\Events\Absence\Absence;
        use CTApi\Models\Events\Absence\AbsenceRequest;

        $absence = AbsenceRequest::findOrFail(118, 211); // for person with id 118 and absence with id 211

        var_dump( $absence->getComment());
        // Output: "Meditation in the monastery."


        $absence->setComment("Vacation in a Hotel.");
        AbsenceRequest::updateAbsence(118, $absence);

        var_dump( $absence->getComment());
        // Output: "Vacation in a Hotel."


```

## Delete Absence

```php
        use CTApi\Models\Events\Absence\Absence;
        use CTApi\Models\Events\Absence\AbsenceRequest;

        $absence = AbsenceRequest::findOrFail(118, 211); // for person with id 118 and absence with id 211

        AbsenceRequest::deleteAbsence(118, $absence);

```