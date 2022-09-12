<?php


namespace Tests\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Requests\PersonRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class PersonTagRequestTest extends TestCaseAuthenticated
{

    private $personId;
    private $tagId;
    private $tagName;

    protected function setUp(): void
    {
        parent::setUp();
        if (!TestData::getValue("PERSON_TAG") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        } else {
            $this->personId = TestData::getValue("PERSON_TAG_PERSON_ID");
            $this->tagId = TestData::getValue("PERSON_TAG_ID");
            $this->tagName = TestData::getValue("PERSON_TAG_NAME");
        }
    }

    public function testRequestIds()
    {
        CTConfig::enableDebugging();
        $person = PersonRequest::findOrFail((int)$this->personId);

        $tags = $person->requestTags()?->get();
        $this->assertNotNull($tags);

        $testTag = null;
        foreach ($tags as $tag) {
            if ($tag->getId() == $this->tagId) {
                $testTag = $tag;
            }
        }

        $this->assertNotNull($testTag, "Could not find tag.");
        $this->assertEquals($this->tagName, $testTag->getName());
    }
}