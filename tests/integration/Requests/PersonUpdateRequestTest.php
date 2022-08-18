<?php


namespace Tests\Integration\Requests;


use CTApi\Requests\PersonRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class PersonUpdateRequestTest extends TestCaseAuthenticated
{
    protected string $birthNameA = "Smith";
    protected string $birthNameB = "Doe";

    protected function setUp(): void
    {
        if (!TestData::getValue("UPDATE_PERSON_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }
    }

    public function testUpdatePersonWholeObject()
    {
        $me = PersonRequest::whoami();

        // select the birthname that is not the current
        $newBirthName = $me->getBirthName() == $this->birthNameA ? $this->birthNameB : $this->birthNameA;

        // Update Birthname
        $me->setBirthName($newBirthName);
        PersonRequest::update($me);

        // Reload Person-Object
        $meReloaded = PersonRequest::whoami();

        $this->assertEquals($meReloaded->getBirthName(), $newBirthName);
    }

    public function testUpdatePersonReducedAttributes()
    {
        $me = PersonRequest::whoami();

        // select the birthname that is not the current
        $newBirthName = $me->getBirthName() == $this->birthNameA ? $this->birthNameB : $this->birthNameA;

        // Update Birthname
        $me->setBirthName($newBirthName);
        PersonRequest::update($me, ["birthName"]);

        // Reload Person-Object
        $meReloaded = PersonRequest::whoami();

        $this->assertEquals($meReloaded->getBirthName(), $newBirthName);
    }
}