<?php

namespace CTApi\Test\Unit\Cache;

use CTApi\CTLog;
use Doctrine\Common\Cache\FilesystemCache;

class CacheProviderMock extends FilesystemCache
{
    private int $fetchTimes = 0;
    private int $saveTimes = 0;

    public function fetch($id)
    {
        $this->fetchTimes += 1;
        CTLog::getLog()->debug("CacheProviderMock: Fetch Data");
        return parent::fetch($id);
    }

    public function save($id, $data, $lifeTime = 0)
    {
        $this->saveTimes += 1;
        CTLog::getLog()->debug("CacheProviderMock: Save Data");
        return parent::save($id, $data, $lifeTime);
    }

    /**
     * @return int
     */
    public function getNumberOfFetches(): int
    {
        return $this->fetchTimes;
    }

    /**
     * @return int
     */
    public function getNumberOfSaves(): int
    {
        return $this->saveTimes;
    }

    public function resetCount(): void
    {
        $this->saveTimes = 0;
        $this->fetchTimes = 0;
    }
}
