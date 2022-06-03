<?php


namespace Tests\Unit\Models;


use CTApi\Models\GroupInformation;
use PHPUnit\Framework\TestCase;

class GroupInformationTest extends TestCase
{

    public function testImages()
    {
        $imageUrl = "https://example.church.tools/86ace43925d8cbc6f67a42559e7860884aae0e1002672f49d28a15092a585a2f";
        $imageUrlBanner = "https://example.church.tools/86ace43925d8cbc6f67a42559e7860884aae0e1002672f49d28a15092a585a2f?p=group-tile";

        $groupInformation = new GroupInformation();

        $this->assertNull($groupInformation->getImageUrl());
        $this->assertNull($groupInformation->getImageUrlBanner());

        $groupInformation->setImageUrl($imageUrl);

        $this->assertEquals($imageUrl, $groupInformation->getImageUrl());
        $this->assertEquals($imageUrlBanner, $groupInformation->getImageUrlBanner());
    }
}