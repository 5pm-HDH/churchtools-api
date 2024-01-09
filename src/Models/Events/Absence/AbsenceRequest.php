<?php

namespace CTApi\Models\Events\Absence;

class AbsenceRequest
{
    public static function forPerson(int $personId)
    {
        return new AbsencePersonRequestBuilder($personId);
    }

    public static function find(int $personId, int $absenceId): ?Absence
    {
        return (new AbsencePersonRequestBuilder($personId))->find($absenceId);
    }

    public static function findOrFail(int $personId, int $absenceId): Absence
    {
        return (new AbsencePersonRequestBuilder($personId))->findOrFail($absenceId);
    }

    public static function createAbsence(int $personId, Absence $absence): void
    {
        (new AbsencePersonRequestBuilder($personId))->create($absence);
    }

    public static function updateAbsence(int $personId, Absence $absence): void
    {
        (new AbsencePersonRequestBuilder($personId))->update($absence);
    }

    public static function deleteAbsence(int $personId, Absence $absence): void
    {
        (new AbsencePersonRequestBuilder($personId))->delete($absence);
    }
}
