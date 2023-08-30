<?php


namespace CTApi\Test\Unit\Requests;


use CTApi\CTClient;
use CTApi\Models\Events\SongStatistic\SongStatisticRequestBuilder;
use CTApi\Test\Unit\HttpMock\CTClientMock;
use CTApi\Test\Unit\TestCaseHttpMocked;

class SongStatisticRequestLazyTest extends TestCaseHttpMocked
{

    public function testLazy()
    {
        $builder = new SongStatisticRequestBuilder(true);

        $builder->find("21");
        $builder->find("22");

        $this->assertNumberOfStatisticRequests(1);
    }

    public function testNotLazy()
    {
        $builder = new SongStatisticRequestBuilder(false);

        $builder->find("21");
        $builder->find("22");

        $this->assertNumberOfStatisticRequests(2);
    }

    private function assertNumberOfStatisticRequests(int $nrOfRequests)
    {
        $client = CTClient::getClient();
        if (is_a($client, CTClientMock::class)) {
            $requestCalls = $client->getAllRequestCalls();
            $this->assertEquals($nrOfRequests, sizeof($requestCalls));
            $client->clearAllRequestCalls();
        } else {
            $this->fail("CTClient is not the CTClientMock");
        }
    }
}