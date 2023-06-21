<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\CTLog;
use CTApi\Models\Common\Tag\Tag;
use CTApi\Models\Events\Song\SongTagRequestBuilder;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class SongTagRequestTest extends TestCaseAuthenticated
{
    private int $songId;
    private int $anyTagId;
    private string $anyTagName;
    private int $anotherTagId;
    private string $anotherTagName;

    protected function setUp(): void
    {
        parent::setUp();
        $this->songId = IntegrationTestData::getFilterAsInt("get_song_tags", "song_id");

        $this->anyTagId = IntegrationTestData::getResultAsInt("get_song_tags", "any_tag.id");
        $this->anyTagName = IntegrationTestData::getResult("get_song_tags", "any_tag.name");
        $this->anotherTagId = IntegrationTestData::getResultAsInt("get_song_tags", "another_tag.id");
        $this->anotherTagName = IntegrationTestData::getResult("get_song_tags", "another_tag.name");
        CTLog::enableHttpLog();
    }

    public function testSongTagAll()
    {
        $tags = (new SongTagRequestBuilder($this->songId))->get();

        $anyTag = null;
        $anotherTag = null;
        foreach ($tags as $tag) {
            if ($tag->getId() == $this->anyTagId) {
                $anyTag = $tag;
            }
            if ($tag->getId() == $this->anotherTagId) {
                $anotherTag = $tag;
            }
        }

        $this->assertInstanceOf(Tag::class, $anyTag);
        $this->assertNotNull($anyTag);
        $this->assertEquals($this->anyTagName, $anyTag->getName());
        $this->assertNotNull($anotherTag);
        $this->assertEquals($this->anotherTagName, $anotherTag->getName());
    }
}