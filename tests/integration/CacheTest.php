<?php


use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Requests\SongRequest;

class CacheTest extends TestCaseAuthenticated
{
    private string $cacheDir = __DIR__ . '/../../cache/';

    public function testCacheSpeedsUpRequest()
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

    public function testClearCacheDump()
    {
        CTConfig::enableCache();
        $this->runSongRequests(1);

        $files = glob($this->cacheDir . "*");
        $this->assertNotEmpty($files);

        CTConfig::clearCache();

        $files = glob($this->cacheDir . "*");
        $this->assertEmpty($files);
    }

    public function runSongRequests(int $numberOfRequests = 10): float
    {
        $startTimeMain = microtime(true);

        for ($i = 0; $i < $numberOfRequests; $i++) {
            $startTime = microtime(true);
            $songRequest = SongRequest::orderBy('id')->get();

            for ($j = 0; $j < sizeof($songRequest) - 1; $j++) {
                $this->assertNotEquals($songRequest[$j]->getId(), $songRequest[$j + 1]->getId(), "Got same song that should be different!");
            }


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