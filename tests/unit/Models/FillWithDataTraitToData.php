<?php


namespace Tests\Unit\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\SongRequest;
use PHPUnit\Framework\TestCase;
use Tests\Unit\TestCaseHttpMocked;

class FillWithDataTraitToData extends TestCaseHttpMocked
{
    public function testCreateSong()
    {
        $song = SongRequest::find(21);

        $this->assertNotNull($song);

        $data = $song->toData();

        $this->assertNotEmpty($data);
        $this->assertEquals("21", $data["id"]);
        $this->assertEquals("We welcome you", $data["name"]);

        // Check that Model-Properties are also casted to array
        $this->assertNotEmpty($data["arrangements"]);
        $lastArrangement = end($data["arrangements"]);
        $this->assertIsArray($lastArrangement);
        $this->assertEquals("221", $lastArrangement["id"]);
    }
}