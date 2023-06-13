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
    const TYPE_BOOL = 6;
    const TYPE_FLOAT = 7;

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

    public function testStringToBool()
    {
        $movie = Movie::createModelFromData(["isReleased" => "true"]);
        $movie->assertProperty("isReleased", self::TYPE_BOOL, true);

        $movie = Movie::createModelFromData(["isReleased" => "false"]);
        $movie->assertProperty("isReleased", self::TYPE_BOOL, false);

        $movie = Movie::createModelFromData(["isReleased" => "0"]);
        $movie->assertProperty("isReleased", self::TYPE_BOOL, false);

        $movie = Movie::createModelFromData(["isReleased" => "1"]);
        $movie->assertProperty("isReleased", self::TYPE_BOOL, false);

        $movie = Movie::createModelFromData(["isReleased" => "invalid"]);
        $movie->assertProperty("isReleased", self::TYPE_NULL);
    }

    public function testStringToFloat()
    {
        $movie = Movie::createModelFromData(["price" => "1.70"]);
        $movie->assertProperty("price", self::TYPE_FLOAT, 1.7);

        $movie = Movie::createModelFromData(["price" => "invalid"]);
        $movie->assertProperty("price", self::TYPE_NULL);
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

    public function testIntToBool()
    {
        $movie = Movie::createModelFromData(["isReleased" => 1]);
        $movie->assertProperty("isReleased", self::TYPE_BOOL, true);

        $movie = Movie::createModelFromData(["isReleased" => 0]);
        $movie->assertProperty("isReleased", self::TYPE_BOOL, false);

        $movie = Movie::createModelFromData(["isReleased" => 2]);
        $movie->assertProperty("isReleased", self::TYPE_NULL);
    }

    public function testIntToFloat()
    {
        $movie = Movie::createModelFromData(["price" => 224]);
        $movie->assertProperty("price", self::TYPE_FLOAT, 224);
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

    public function testArrayToBool()
    {
        $movie = Movie::createModelFromData(["isReleased" => [true, false, true]]);
        $movie->assertProperty("isReleased", self::TYPE_NULL);
    }

    public function testArrayToFloat()
    {
        $movie = Movie::createModelFromData(["price" => [22.4, 22]]);
        $movie->assertProperty("price", self::TYPE_NULL);
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

    public function testClassToBool()
    {
        $actor = (new Actor())->setId(21)->setName("Little Kid");
        $movie = Movie::createModelFromData(["isReleased" => $actor]);
        $movie->assertProperty("isReleased", self::TYPE_NULL);
    }

    public function testClassToFloat()
    {
        $actor = (new Actor())->setId(21)->setName("Little Kid");
        $movie = Movie::createModelFromData(["price" => $actor]);
        $movie->assertProperty("price", self::TYPE_NULL);
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

    public function testNullToBool()
    {
        $movie = Movie::createModelFromData(["isReleased" => null]);
        $movie->assertProperty("isReleased", self::TYPE_NULL);
    }

    public function testNullToFloat()
    {
        $movie = Movie::createModelFromData(["price" => null]);
        $movie->assertProperty("price", self::TYPE_NULL);
    }

    /**
     * Test: Bool
     */

    public function testBoolToString()
    {
        $movie = Movie::createModelFromData(["title" => true]);
        $movie->assertProperty("title", self::TYPE_STRING, "true");

        $movie = Movie::createModelFromData(["title" => false]);
        $movie->assertProperty("title", self::TYPE_STRING, "false");
    }

    public function testBoolToInt()
    {
        $movie = Movie::createModelFromData(["id" => true]);
        $movie->assertProperty("id", self::TYPE_INT, 1);

        $movie = Movie::createModelFromData(["id" => false]);
        $movie->assertProperty("id", self::TYPE_INT, 0);
    }

    public function testBoolToArray()
    {
        $movie = Movie::createModelFromData(["starRatings" => true]);
        $movie->assertProperty("starRatings", self::TYPE_ARRAY, []);
    }

    public function testBoolToClass()
    {
        $movie = Movie::createModelFromData(["mainActor" => true]);
        $movie->assertProperty("mainActor", self::TYPE_NULL);
    }

    public function testBoolToNone()
    {
        $movie = Movie::createModelFromData(["undefinedProperty" => true]);
        $movie->assertProperty("undefinedProperty", self::TYPE_NONE);
    }

    public function testBoolToBool()
    {
        $movie = Movie::createModelFromData(["isReleased" => true]);
        $movie->assertProperty("isReleased", self::TYPE_BOOL, true);

        $movie = Movie::createModelFromData(["isReleased" => false]);
        $movie->assertProperty("isReleased", self::TYPE_BOOL, false);
    }

    public function testBoolToFloat()
    {
        $movie = Movie::createModelFromData(["price" => true]);
        $movie->assertProperty("price", self::TYPE_NULL);

        $movie = Movie::createModelFromData(["price" => false]);
        $movie->assertProperty("price", self::TYPE_NULL);
    }

    /**
     * Test: Float
     */

    public function testFloatToString()
    {
        $movie = Movie::createModelFromData(["title" => 21.21]);
        $movie->assertProperty("title", self::TYPE_STRING, "21.21");
    }

    public function testFloatToInt()
    {
        $movie = Movie::createModelFromData(["id" => 9.21]);
        $movie->assertProperty("id", self::TYPE_INT, 9);
    }

    public function testFloatToArray()
    {
        $movie = Movie::createModelFromData(["starRatings" => 921.21]);
        $movie->assertProperty("starRatings", self::TYPE_ARRAY, []);
    }

    public function testFloatToClass()
    {
        $movie = Movie::createModelFromData(["mainActor" => 22.2]);
        $movie->assertProperty("mainActor", self::TYPE_NULL);
    }

    public function testFloatToNone()
    {
        $movie = Movie::createModelFromData(["undefinedProperty" => 9.2]);
        $movie->assertProperty("undefinedProperty", self::TYPE_NONE);
    }

    public function testFloatToBool()
    {
        $movie = Movie::createModelFromData(["isReleased" => 1.5]);
        $movie->assertProperty("isReleased", self::TYPE_NULL);

        $movie = Movie::createModelFromData(["isReleased" => 0.5]);
        $movie->assertProperty("isReleased", self::TYPE_NULL);
    }

    public function testFloatToFloat()
    {
        $movie = Movie::createModelFromData(["price" => 225.2]);
        $movie->assertProperty("price", self::TYPE_FLOAT, 225.2);
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

    protected ?bool $isReleased = null;
    protected ?float $price = null;

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
            case FillWithDataTraitTypeMissmatchTest::TYPE_BOOL:
                TestCase::assertTrue(is_bool($property), "Property " . $propertyKey . " is not from type bool as expected: " . gettype($property));
                break;
            case FillWithDataTraitTypeMissmatchTest::TYPE_FLOAT:
                TestCase::assertTrue(is_float($property), "Property " . $propertyKey . " is not from type float as expected: " . gettype($property));
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