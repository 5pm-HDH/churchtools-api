<?php

namespace CTApi\Test\Unit\Models;

use CTApi\Models\Groups\Person\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    /**
     * @dataProvider addDepartmentIdProvider
     */
    public function testAddDepartmentId(array $idsToAdd, array $expectedIds): void
    {
        $person = new Person();

        foreach ($idsToAdd as $id) {
            $person->addDepartmentId($id);
        }

        $departmentIds = $person->getDepartmentIds();

        $this->assertSame($expectedIds, $departmentIds);
    }

    public function addDepartmentIdProvider(): array
    {
        return [
            [[], []], // make sure array is empty after initialization
            [[1], [1]], // make sure one department is correctly added
            [[1, 3], [1, 3]], // make sure multiple departments are correctly added
            [[1, 3, 3], [1, 3]],  // make sure that only unique IDs are added.
        ];
    }

    /**
     * @dataProvider removeDepartmentIdProvider
     */
    public function testRemoveDepartmentId(array $idsToRemove, array $expectedIds): void
    {
        $person = new Person();
        $person->addDepartmentId(1);
        $person->addDepartmentId(2);
        $person->addDepartmentId(3);

        foreach ($idsToRemove as $id) {
            $person->removeDepartmentId($id);
        }

        $departmentIds = $person->getDepartmentIds();

        $this->assertSame($expectedIds, $departmentIds);
    }

    public function removeDepartmentIdProvider(): array
    {
        return [
            [[], [1, 2, 3]], // make sure that array contains correct IDs
            [[1], [2, 3]], // make sure that one ID is correctly removed
            [[1, 2, 3], []], // make sure that multiple IDs are correctly removed
            [[4], [1, 2, 3]], // make sure that nothing is changed if an ID is removed that is not contained by the departments.
        ];
    }
}
