<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\CTClient;
use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Models\Tag;
use CTApi\Requests\GroupRequest;
use CTApi\Requests\TagRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;
use CTApi\Utils\CTResponseUtil;

class TagRequestTest extends TestCaseAuthenticated
{
    private int $songTagId;
    private string $songTagName;
    private int $personTagId;
    private string $personTagName;

    protected function setUp(): void
    {
        parent::setUp();
        $this->songTagId = IntegrationTestData::getFilterAsInt("get_tags", "song_tag_id");
        $this->songTagName = IntegrationTestData::getResult("get_tags", "song_tag.name");
        $this->personTagId = IntegrationTestData::getFilterAsInt("get_tags", "person_tag_id");
        $this->personTagName = IntegrationTestData::getResult("get_tags", "person_tag.name");
    }

    public function testAllSongTags()
    {
        // Retrieve all
        $allSongTags = TagRequest::allSongTags();

        $foundSongTag = null;
        foreach($allSongTags as $tag){
            if($tag->getId() == $this->songTagId){
                $foundSongTag = $tag;
            }
        }

        $this->assertNotNull($foundSongTag);
        $this->assertEquals($this->songTagName, $foundSongTag->getName());

        // Retrieve one
        $foundSongTag = TagRequest::findSongTagOrFail($this->songTagId);
        $this->assertEquals($this->songTagName, $foundSongTag->getName());
    }

    public function testAllPersonTags()
    {
        // Retrieve all
        $allPersonTags = TagRequest::allPersonTags();

        $foundPersonTag = null;
        foreach($allPersonTags as $tag){
            if($tag->getId() == $this->personTagId){
                $foundPersonTag = $tag;
            }
        }

        $this->assertNotNull($foundPersonTag);
        $this->assertEquals($this->personTagName, $foundPersonTag->getName());

        // Retrieve one
        $foundPersonTag = TagRequest::findPersonTagOrFail($this->personTagId);
        $this->assertEquals($this->personTagName, $foundPersonTag->getName());
    }

    public function testGroupTags()
    {
        $group = GroupRequest::findOrFail(IntegrationTestData::getFilterAsInt("get_group", "id"));

        $tags = $group->requestTags()?->get();

        $searchedTagId = IntegrationTestData::getResultAsInt("get_group", "any_tag.id");

        $this->assertNotEmpty($tags);
        $foundTag = null;
        foreach($tags as $tag){
            if($tag->getId() == $searchedTagId){
                $foundTag = $tag;
            }
        }

        $this->assertNotNull($foundTag);
        $this->assertEqualsTestData("get_group", "any_tag.name", $foundTag->getName());
    }
}