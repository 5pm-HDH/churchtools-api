<?php


namespace Tests\Unit\Models;


use CTApi\CTLog;
use CTApi\Models\Traits\FillWithData;
use PHPUnit\Framework\TestCase;

class FillWithDataTraitTypeMissmatchTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        CTLog::enableConsoleLog();
    }

    /**
     * Types to be tested:
     * <li>String</li>
     * <li>Int</li>
     * <li>Array<li>
     * <li>Class</li>
     * <li>null</li>
     */

    const TYPE_STRING = 0;
    const TYPE_INT = 1;
    const TYPE_ARRAY = 2;
    const TYPE_CLASS = 3;
    const TYPE_NULL = 4;
    const TYPE_NONE = 5;

    /**
     * Test: String
     */

    public function testStringToString()
    {
        $movie = Movie::createModelFromData(["title" => "The Godfather"]);
        $movie->assertProperty("title", self::TYPE_STRING, "The Godfather");
    }

    public function testStringToInt()
    {
        $movie = Movie::createModelFromData(["id" => "GUID:2"]);
        $movie->assertProperty("id", self::TYPE_NULL);

        $movie = Movie::createModelFromData(["id" => "21"]);
        $movie->assertProperty("id", self::TYPE_INT, 21);
    }

    public function testStringToArray()
    {
        $movie = Movie::createModelFromData(["starRatings" => "StringValue"]);
        $movie->assertProperty("starRatings", self::TYPE_ARRAY, []);
    }

    public function testStringToClass()
    {
        $movie = Movie::createModelFromData(["mainActor" => "StringValueForObject"]);
        $movie->assertProperty("mainActor", self::TYPE_NULL);
    }

    public function testStringToNone()
    {
        $movie = Movie::createModelFromData(["undefinedProperty" => "TestPropertyValue"]);
        $movie->assertProperty("undefinedProperty", self::TYPE_NONE);
    }

    /**
     * Test: Int
     */

    public function testIntToString()
    {
        $movie = Movie::createModelFromData(["title" => 21]);
        $movie->assertProperty("title", self::TYPE_STRING, "21");
    }

    public function testIntToInt()
    {
        $movie = Movie::createModelFromData(["id" => 21]);
        $movie->assertProperty("id", self::TYPE_INT, 21);
    }

    public function testIntToArray()
    {
        $movie = Movie::createModelFromData(["starRatings" => 21]);
        $movie->assertProperty("starRatings", self::TYPE_ARRAY, []);
    }

    public function testIntToClass()
    {
        $movie = Movie::createModelFromData(["mainActor" => 2]);
        $movie->assertProperty("mainActor", self::TYPE_NULL);
    }

    public function testIntToNone()
    {
        $movie = Movie::createModelFromData(["undefinedProperty" => 3]);
        $movie->assertProperty("undefinedProperty", self::TYPE_NONE);
    }

    /**
     * Test: Array
     */

    public function testArrayToString()
    {
        $movie = Movie::createModelFromData(["title" => ["Title A", "Title B"]]);
        $movie->assertProperty("title", self::TYPE_NULL);
    }

    public function testArrayToInt()
    {
        $movie = Movie::createModelFromData(["id" => [21, 22, 23]]);
        $movie->assertProperty("id", self::TYPE_NULL);
    }

    public function testArrayToArray()
    {
        $movie = Movie::createModelFromData(["starRatings" => [80, 20, 40]]);
        $movie->assertProperty("starRatings", self::TYPE_ARRAY, [80, 20, 40]);
    }

    public function testArrayToClass()
    {
        $movie = Movie::createModelFromData(["mainActor" => ["id" => 21, "name" => "Test Actor"]]);
        $movie->assertProperty("mainActor", self::TYPE_NULL);
    }

    public function testArrayToNone()
    {
        $movie = Movie::createModelFromData(["undefinedProperty" => ["id" => 21]]);
        $movie->assertProperty("undefinedProperty", self::TYPE_NONE);
    }

    /**
     * Test: Class
     */

    public function testClassToString()
    {
        $actor = (new Actor())->setId(21)->setName("Little Kid");
        $movie = Movie::createModelFromData(["title" => $actor]);
        $movie->assertProperty("title", self::TYPE_NULL);
    }

    public function testClassToInt()
    {
        $actor = (new Actor())->setId(21)->setName("Little Kid");
        $movie = Movie::createModelFromData(["id" => $actor]);
        $movie->assertProperty("id", self::TYPE_NULL);
    }

    public function testClassToArray()
    {
        $actor = (new Actor())->setId(21)->setName("Little Kid");
        $movie = Movie::createModelFromData(["starRatings" => $actor]);
        $movie->assertProperty("starRatings", self::TYPE_ARRAY);
    }

    public function testClassToClass()
    {
        $actor = (new Actor())->setId(21)->setName("Little Kid");
        $movie = Movie::createModelFromData(["mainActor" => $actor]);
        $movie->assertProperty("mainActor", self::TYPE_CLASS, $actor);
    }

    public function testClassToNone()
    {
        $actor = (new Actor())->setId(21)->setName("Little Kid");
        $movie = Movie::createModelFromData(["undefinedProperty" => $actor]);
        $movie->assertProperty("undefinedProperty", self::TYPE_NONE);
    }

    /**
     * Test: Null
     */

    public function testNullToString()
    {
        $movie = Movie::createModelFromData(["title" => null]);
        $movie->assertProperty("title", self::TYPE_NULL);
    }

    public function testNullToInt()
    {
        $movie = Movie::createModelFromData(["id" => null]);
        $movie->assertProperty("id", self::TYPE_NULL);

        $movie = Movie::createModelFromData(["id" => null]);
        $movie->assertProperty("id", self::TYPE_NULL);
    }

    public function testNullToArray()
    {
        $movie = Movie::createModelFromData(["starRatings" => null, "starRatingsNullable" => null]); // star ratings is not nullable
        $movie->assertProperty("starRatings", self::TYPE_ARRAY, []);
        $movie->assertProperty("starRatingsNullable", self::TYPE_NULL);
    }

    public function testNullToClass()
    {
        $movie = Movie::createModelFromData(["mainActor" => null]);
        $movie->assertProperty("mainActor", self::TYPE_NULL);
    }

    public function testNullToNone()
    {
        $movie = Movie::createModelFromData(["undefinedProperty" => null]);
        $movie->assertProperty("undefinedProperty", self::TYPE_NONE);
    }
}

class Movie
{

    use FillWithData;

    protected ?int $id = null;
    protected ?string $title = null;
    protected array $actors = []; // array with Actor-Classes
    protected ?Actor $mainActor = null;
    protected array $starRatings = []; // array with "*"-strings
    protected ?array $starRatingsNullable = [];

    public function assertProperty(string $propertyKey, int $propertyType, $value = null)
    {
        $attributes = get_object_vars($this);

        if ($propertyType == FillWithDataTraitTypeMissmatchTest::TYPE_NONE) {
            TestCase::assertFalse(array_key_exists($propertyKey, $attributes), "Property " . $propertyKey . " exists in Movie-Model, but it sould not be available: " . json_encode($attributes));
            return;
        } else {
            TestCase::assertTrue(array_key_exists($propertyKey, $attributes), "Property " . $propertyKey . " does not exists in Movie-Model: " . json_encode($attributes));
        }

        $property = $attributes[$propertyKey];
        switch ($propertyType) {
            case FillWithDataTraitTypeMissmatchTest::TYPE_STRING:
                TestCase::assertTrue(is_string($property), "Property " . $propertyKey . " is not from type string as expected: " . gettype($property));
                break;
            case FillWithDataTraitTypeMissmatchTest::TYPE_INT:
                TestCase::assertTrue(is_int($property), "Property " . $propertyKey . " is not from type int as expected: " . gettype($property));
                break;
            case FillWithDataTraitTypeMissmatchTest::TYPE_ARRAY:
                TestCase::assertTrue(is_array($property), "Property " . $propertyKey . " is not from type array as expected: " . gettype($property));
                break;
            case FillWithDataTraitTypeMissmatchTest::TYPE_CLASS:
                TestCase::assertTrue(is_object($property), "Property " . $propertyKey . " is not from type class as expected: " . gettype($property));
                break;
            case FillWithDataTraitTypeMissmatchTest::TYPE_NULL:
                TestCase::assertTrue(is_null($property), "Property " . $propertyKey . " is not from type null as expected: " . gettype($property));
                break;
            default:
                TestCase::fail("Given in PropertyType is invalid: " . $propertyType);
        }

        if ($value) {
            TestCase::assertEquals($value, $property, "Property has not expected value.");
        }
    }
}

class Actor
{
    use FillWithData;

    protected ?int $id;
    protected ?string $name;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Actor
     */
    public function setId(?int $id): Actor
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Actor
     */
    public function setName(?string $name): Actor
    {
        $this->name = $name;
        return $this;
    }
}