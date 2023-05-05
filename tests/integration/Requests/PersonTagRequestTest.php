<?php


namespace Tests\Integration\Requests;


use CTApi\Requests\PersonRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class PersonTagRequestTest extends TestCaseAuthenticated
{

    private $personId;
    private $tagId;
    private $tagName;

    protected function setUp(): void
    {
        $this->personId = IntegrationTestData::getFilter("get_person_tags", "person_id");
        $this->tagId = IntegrationTestData::getResult("get_person_tags", "any_tag.id");
        $this->tagName = IntegrationTestData::getResult("get_person_tags", "any_tag.name");
    }

    public function testRequestIds()
    {
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