<?php

namespace CTApi\Test\Unit\Cache;

use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Middleware\CTCacheMiddleware;
use CTApi\Models\Events\Event\Event;
use CTApi\Utils\CTMessageBody;
use CTApi\Utils\CTRequest;
use CTApi\Utils\CTResponse;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class CTCacheMiddlewareTest extends TestCase
{
    private CacheProviderMock $cacheProviderMock;

    private RequestInterface $eventRequest;
    private array $httpReturnData = [];
    private Event $eventModel;


    public function setUp(): void
    {
        CTConfig::clearCache();

        $this->cacheProviderMock = new CacheProviderMock(__DIR__ . '/../../../cache/');
        CTCacheMiddleware::setCacheDriver($this->cacheProviderMock);

        // Create Test Data
        $this->httpReturnData = [
            'data' => [
                'id' => 29,
                'name' => "Sunday Service"
            ]
        ];

        $this->createEventRequest();

        $this->eventModel = Event::createModelFromData($this->httpReturnData['data']);
    }

    private function createEventRequest(): void
    {
        $this->eventRequest = new CTRequest();
        $this->eventRequest->withUri(new Uri('/events/29'));
    }

    public function testRequestEventTwice(): void
    {
        // This Invoke should store "this->returnData" to the Cache!
        $responsePromise = $this->invokeCacheMiddleware($this->eventRequest, [], $this->httpReturnData);


        $response = $responsePromise->wait();
        $eventData = CTResponseUtil::dataAsArray($response);
        $responseEvent = Event::createModelFromData($eventData);

        $this->assertEquals($this->eventModel, $responseEvent);
        $this->assertEquals(1, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfFetches());


        // This Invoke should retrieve data from Cache! So the given in Data should be ignored and can be null
        $this->cacheProviderMock->resetCount();
        $responsePromise = $this->invokeCacheMiddleware($this->eventRequest, [], null);

        $response = $responsePromise->wait();
        $eventData = CTResponseUtil::dataAsArray($response);

        $eventModel = Event::createModelFromData($eventData);

        $this->assertEquals($eventModel, $this->eventModel);
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(1, $this->cacheProviderMock->getNumberOfFetches());
    }

    public function testDontSaveNoCacheHeaderRequest(): void
    {
        // Request should not be stored!
        $this->eventRequest->withAddedHeader('Cache-Control', 'no-cache');
        $responsePromise = $this->invokeCacheMiddleware($this->eventRequest, [], $this->httpReturnData);

        $response = $responsePromise->wait();
        $eventData = CTResponseUtil::dataAsArray($response);
        $eventModel = Event::createModelFromData($eventData);

        $this->assertEquals($eventModel, $this->eventModel);
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfFetches());


        // Request can not find data in cache => return null
        $this->createEventRequest();
        $this->cacheProviderMock->resetCount();
        $responsePromise = $this->invokeCacheMiddleware($this->eventRequest, [], []);

        $response = $responsePromise->wait();
        $eventData = CTResponseUtil::dataAsArray($response);

        $this->assertEmpty($eventData);

        $this->assertEquals(1, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfFetches());
    }

    public function testDontRetrieveNoCacheHeaderRequest(): void
    {
        // Request should be stored!
        $responsePromise = $this->invokeCacheMiddleware($this->eventRequest, [], $this->httpReturnData);

        $response = $responsePromise->wait();
        $eventData = CTResponseUtil::dataAsArray($response);
        $eventModel = Event::createModelFromData($eventData);

        $this->assertEquals($eventModel, $this->eventModel);
        $this->assertEquals(1, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfFetches());


        // Request should not be retrieved from cache
        $this->cacheProviderMock->resetCount();
        $this->createEventRequest();
        $this->eventRequest->withAddedHeader('Cache-Control', 'no-cache');
        $responsePromise = $this->invokeCacheMiddleware($this->eventRequest, [], []);

        $response = $responsePromise->wait();
        $eventData = CTResponseUtil::dataAsArray($response);

        $this->assertEmpty($eventData);

        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfFetches());
    }

    public function testDifferRequestByBody(): void
    {
        $requestA = (new CTRequest())->withUri(new Uri('/api/events'))->withBody(new CTMessageBody(['page' => 2]));
        $requestB = (new CTRequest())->withUri(new Uri('/api/events'))->withBody(new CTMessageBody(['page' => 3]));

        $responseA = $this->invokeCacheMiddleware($requestA, [], ["Answer A"])->wait();
        $responseB = $this->invokeCacheMiddleware($requestB, [], ["Answer B"])->wait();

        $this->assertEquals(2, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfFetches());
        $this->assertEquals(["Answer A"], CTResponseUtil::jsonToArray($responseA));
        $this->assertEquals(["Answer B"], CTResponseUtil::jsonToArray($responseB));

        // Redo HTTP-Request: Now it should retrieve data from cache
        $this->cacheProviderMock->resetCount();

        $responseSecondA = $this->invokeCacheMiddleware($requestA, [], ["Answer Second Invoke A"])->wait();
        $responseSecondB = $this->invokeCacheMiddleware($requestB, [], ["Answer Second Invoke B"])->wait();

        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(2, $this->cacheProviderMock->getNumberOfFetches());
        $this->assertEquals(["Answer A"], CTResponseUtil::jsonToArray($responseA));
        $this->assertEquals(["Answer B"], CTResponseUtil::jsonToArray($responseB));
    }

    public function testTimeToLive(): void
    {
        CTCacheMiddleware::setTimeToLive(1);

        $requestA = (new CTRequest())->withUri(new Uri('/api/events'));

        // Store to Cache (T1)
        $responseA = $this->invokeCacheMiddleware($requestA, [], ["Answer T1"])->wait();

        $this->assertEquals(["Answer T1"], CTResponseUtil::jsonToArray($responseA));
        $this->assertEquals(1, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfFetches());

        // Fetch from Cache (T2) - Cache is not expired!
        $this->cacheProviderMock->resetCount();
        $responseA = $this->invokeCacheMiddleware($requestA, [], ["Answer T2"])->wait();

        $this->assertEquals(["Answer T1"], CTResponseUtil::jsonToArray($responseA));
        $this->assertEquals(0, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(1, $this->cacheProviderMock->getNumberOfFetches());

        // Fetch from HTTP (T3) - Cache is expired!
        sleep(2);
        $this->cacheProviderMock->resetCount();

        $responseA = $this->invokeCacheMiddleware($requestA, [], ["Answer T3"])->wait();

        $this->assertEquals(["Answer T3"], CTResponseUtil::jsonToArray($responseA));
        $this->assertEquals(1, $this->cacheProviderMock->getNumberOfSaves());
        $this->assertEquals(1, $this->cacheProviderMock->getNumberOfFetches());

    }

    public function invokeCacheMiddleware(RequestInterface $request, $options, $httpReturnData): Promise
    {
        $cacheMiddleware = CTCacheMiddleware::create();

        $executable = $cacheMiddleware(function (RequestInterface $tempRequest, $options) use ($httpReturnData) {
            CTLog::getLog()->debug("CTCacheMiddlewareTest: Invoke Handler");
            $promise = new Promise();

            $promise->resolve(CTResponse::createFromRequestAndData($tempRequest, $httpReturnData));

            return $promise;
        });

        return $executable($request, $options);
    }
}
