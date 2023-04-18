<?php


namespace Tests\Unit\Models;


use CTApi\Models\GroupInformation;
use PHPUnit\Framework\TestCase;

class GroupInformationTest extends TestCase
{

    private $imageUrl = "https://example.church.tools/86ace43925d8cbc6f67a42559e7860884aae0e1002672f49d28a15092a585a2f";
    private $imageUrlBanner = "https://example.church.tools/86ace43925d8cbc6f67a42559e7860884aae0e1002672f49d28a15092a585a2f?p=group-tile";

    public function testImages()
    {
        $groupInformation = new GroupInformation();

        $this->assertNull($groupInformation->getImageUrl());
        $this->assertNull($groupInformation->getImageUrlBanner());

        $groupInformation->setImageUrl($this->imageUrl);

        $this->assertEquals($this->imageUrl, $groupInformation->getImageUrl());
        $this->assertEquals($this->imageUrlBanner, $groupInformation->getImageUrlBanner());
    }

    public function testToDataOutput()
    {
        $groupInformation = new GroupInformation();
        $groupInformation->setImageUrl($this->imageUrl);

        $data = $groupInformation->toData();

        $this->assertArrayHasKey("imageUrl", $data);
        $this->assertEquals($data["imageUrl"], $this->imageUrl);
        $this->assertArrayHasKey("imageUrlBanner", $data);
        $this->assertEquals($data["imageUrlBanner"], $this->imageUrlBanner);
    }
}