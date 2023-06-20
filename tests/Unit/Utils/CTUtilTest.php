<?php

namespace CTApi\Test\Unit\Utils;

use CTApi\Utils\CTUtil;
use PHPUnit\Framework\TestCase;

class CTUtilTest extends TestCase
{
    private array $exampleArray;

    protected function setUp(): void
    {
        $this->exampleArray = [
            "name" => "Steve",
            "job" => [
                "name" => "Software Engineer",
                "selling" => 20000,
                "languages" => ["php", "java", "python"]
            ],
            "tags" => [
                "pizza", "coke", "lasagne"
            ],
            "base_uri" => "https://url.com",
            "fake" => null
        ];
    }

    public function testArrayPathGetter(): void
    {

        $this->assertEquals("https://url.com", CTUtil::arrayPathGet($this->exampleArray, 'base_uri'));
        $this->assertEquals("Steve", CTUtil::arrayPathGet($this->exampleArray, 'name'));
        $this->assertEquals("Software Engineer", CTUtil::arrayPathGet($this->exampleArray, 'job.name'));
        $this->assertEquals(20000, CTUtil::arrayPathGet($this->exampleArray, 'job.selling'));
        $this->assertEquals(["php", "java", "python"], CTUtil::arrayPathGet($this->exampleArray, 'job.languages'));

        $this->assertNull(CTUtil::arrayPathGet($this->exampleArray, "not.found"));
        $this->assertNull(CTUtil::arrayPathGet($this->exampleArray, "job.languages.not.found"));
        $this->assertNull(CTUtil::arrayPathGet($this->exampleArray, ''));

    }

    public function testArrayPathSetter(): void
    {
        // set simple type
        CTUtil::arrayPathSet($this->exampleArray, 'name', "Carl");
        $this->assertEquals("Carl", $this->exampleArray['name']);

        // set simple type nested
        CTUtil::arrayPathSet($this->exampleArray, 'job.selling', 50000);
        $this->assertEquals(50000, $this->exampleArray['job']['selling']);

        //append Element to List
        CTUtil::arrayPathSet($this->exampleArray, 'tags', "kebab");
        $this->assertEquals(["pizza", "coke", "lasagne", "kebab"], $this->exampleArray["tags"]);

        //append Element to Array
        CTUtil::arrayPathSet($this->exampleArray, 'job', ["isPrimary" => true]);
        $this->assertTrue($this->exampleArray["job"]["isPrimary"]);
    }

    public function testArrayPathCreateElement(): void
    {
        CTUtil::arrayPathSet($this->exampleArray, 'age', 21);
        $this->assertEquals(21, $this->exampleArray['age']);
    }

    public function testArrayPathSetFake(): void
    {
        CTUtil::arrayPathSet($this->exampleArray, 'fake.age', 21);
        $this->assertEquals(21, $this->exampleArray['fake']['age']);
    }
}