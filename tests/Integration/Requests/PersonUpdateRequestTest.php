<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Integration\TestCaseAuthenticated;

class PersonUpdateRequestTest extends TestCaseAuthenticated
{
    protected string $birthNameA = "Smith";
    protected string $birthNameB = "Doe";

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUpdatePersonWholeObject()
    {
        $me = PersonRequest::whoami();

        // select the birthname that is not the current
        $newBirthName = $me->getBirthName() == $this->birthNameA ? $this->birthNameB : $this->birthNameA;

        // Update Birthname
        $me->setBirthName($newBirthName);
        PersonRequest::update($me, ["birthName", "firstName", "lastName"]);

        // Reload Person-Object
        $meReloaded = PersonRequest::whoami();

        $this->assertEquals($meReloaded->getBirthName(), $newBirthName);
    }

    public function testUpdatePersonReducedAttributes()
    {
        self::reauthenticateChurchToolsUser();

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