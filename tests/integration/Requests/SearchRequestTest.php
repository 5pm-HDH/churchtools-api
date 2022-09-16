<?php


namespace Tests\Integration\Requests;


use CTApi\Models\SearchResult;
use CTApi\Requests\SearchRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class SearchRequestTest extends TestCaseAuthenticated
{
    private string $query;
    private string $personLastName;

    protected function setUp(): void
    {
        $this->checkIfTestSuiteIsEnabled("SEARCH_PERSON");
        $this->query = TestData::getValue("SEARCH_PERSON_QUERY");
        $this->personLastName = TestData::getValue("SEARCH_PERSON_LAST_NAME");
    }

    public function testSearchUser()
    {
        $result = SearchRequest::search($this->query)->get();
        $this->assertSearchResultContainsPerson($result);
    }

    public function testSearchUserWithDomain()
    {
        $result = SearchRequest::search($this->query)->whereDomainType("person")->get();
        $this->assertSearchResultContainsPerson($result);
    }

    public function testSearchUserWithWrongDomain()
    {
        $result = SearchRequest::search($this->query)->whereDomainType("song")->get();
        $this->assertSearchResultContainsPerson($result, false);
    }

    public function assertSearchResultContainsPerson(array $searchResult, bool $yes = true)
    {
        $foundUserResult = null;
        foreach ($searchResult as $result) {
            $this->assertInstanceOf(SearchResult::class, $result);
            $this->assertNotNull($result);
            if (str_contains($result?->getTitle() ?? "", $this->personLastName)) {
                $foundUserResult = $result;
            }
        }

        if ($yes) {
            $this->assertNotNull($foundUserResult, "Could not found user with last name " . $this->personLastName);
            $this->assertArrayHasKey("lastName", $foundUserResult->getDomainAttributes());
            $this->assertEquals($this->personLastName, $foundUserResult->getDomainAttributes()["lastName"]);
        } else {
            $this->assertNull($foundUserResult, "Found result for user with last name " . $this->personLastName . " but expected no result.");
        }
    }
}