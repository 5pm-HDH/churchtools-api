<?php

namespace CTApi\Test\Integration;

use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Models\Events\Song\SongRequest;

class CacheTest extends TestCaseAuthenticated
{
    private string $cacheDir = __DIR__ . '/../../cache/';

    public function tearDown(): void
    {
        parent::tearDown();
        // disable cache even if cache fails
        CTConfig::disableCache();
    }

    public function testCacheSpeedsUpRequest(): void
    {
        CTConfig::clearCache();
        $numberOfRequests = 2;

        CTLog::getLog()->debug("CacheTest:testCacheSpeedsUpRequest - DISABLE CACHE:");

        CTConfig::disableCache();
        $timeWithoutCache = $this->runSongRequests($numberOfRequests);

        CTLog::getLog()->debug("CacheTest:testCacheSpeedsUpRequest - ENABLE CACHE:");

        CTConfig::clearCache();
        CTConfig::enableCache();
        $timeWithCache = $this->runSongRequests($numberOfRequests);

        CTLog::getLog()->debug("CacheTest:testCacheSpeedsUpRequest - RESULTS");

        $percentFaster = ($timeWithoutCache - $timeWithCache) / $timeWithoutCache;

        CTLog::getLog()->info("CacheTest: Requested all Songs " . $numberOfRequests . "-times.");
        CTLog::getLog()->info("CacheTest: Execution-time without cache: " . $timeWithoutCache . " secs");
        CTLog::getLog()->info("CacheTest: Execution-time with cache: " . $timeWithCache . " secs");
        CTLog::getLog()->info("CacheTest: With cache the whole execution was " . ((int)($percentFaster * 100)) . " % faster");

        $this->assertGreaterThan($timeWithCache, $timeWithoutCache,);
        $this->assertGreaterThan(0.1, $percentFaster);

    }

    public function testClearCacheDump(): void
    {
        CTConfig::enableCache();
        $this->runSongRequests(1);

        $files = glob($this->cacheDir . "*");
        $this->assertNotEmpty($files);

        CTConfig::clearCache();

        $files = glob($this->cacheDir . "*");
        $this->assertEqualsWithDelta(sizeof($files), 0, 1);
    }

    public function runSongRequests(int $numberOfRequests = 10): float
    {
        $startTimeMain = microtime(true);

        for ($i = 0; $i < $numberOfRequests; $i++) {
            $startTime = microtime(true);
            $songRequest = SongRequest::orderBy('id')->get();

            $time = microtime(true) - $startTime;
            $time = $time * 100;
            $time = (int)$time;
            $time = $time / 100;
        }

        $time = microtime(true) - $startTimeMain;
        $time = $time * 100;
        $time = (int)$time;
        $time = $time / 100;

        return $time;
    }

}