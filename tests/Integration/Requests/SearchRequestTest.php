<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Models\Common\Search\SearchRequest;
use CTApi\Models\Common\Search\SearchResult;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class SearchRequestTest extends TestCaseAuthenticated
{
    private string $queryPerson;
    private string $personLastName;

    protected function setUp(): void
    {
        $this->queryPerson = IntegrationTestData::getFilter("search_person", "query");
        $this->personLastName = IntegrationTestData::getResult("search_person", "any_person.last_name");
    }

    public function testSearchUser()
    {
        $result = SearchRequest::search($this->queryPerson)->get();
        $this->assertSearchResultContainsPerson($result);
    }

    public function testSearchUserWithDomain()
    {
        $result = SearchRequest::search($this->queryPerson)->whereDomainType("person")->get();
        $this->assertSearchResultContainsPerson($result);
    }

    public function testSearchUserWithWrongDomain()
    {
        $result = SearchRequest::search($this->queryPerson)->whereDomainType("song")->get();
        $this->assertSearchResultContainsPerson($result, false);
    }

    public function assertSearchResultContainsPerson(array $searchResult, bool $yes = true)
    {
        $foundUserResult = null;
        foreach ($searchResult as $result) {
            $this->assertInstanceOf(SearchResult::class, $result);
            $this->assertNotNull($result);
            if (str_contains($result->getTitle() ?? "", $this->personLastName)) {
                $foundUserResult = $result;
            }
        }

        if ($yes) {
            $this->assertNotNull($foundUserResult, "Could not found user with last name " . $this->personLastName);
            // TODO #209:
            //$this->assertArrayHasKey("lastName", $foundUserResult->getDomainAttributes());
            //$this->assertEquals($this->personLastName, $foundUserResult->getDomainAttributes()["lastName"]);
        } else {
            $this->assertNull($foundUserResult, "Found result for user with last name " . $this->personLastName . " but expected no result.");
        }
    }
}
