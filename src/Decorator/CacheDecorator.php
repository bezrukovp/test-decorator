<?php

namespace src\Decorator;

use DateTime;
use Psr\Cache\CacheItemPoolInterface;
use src\Integration\DataProviderInterface;

class CacheDecorator extends AbstractDecorator
{
    private $cache;


    public function setCacheItemPool(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function get(array $input)
    {
        $cacheKey = $this->getCacheKey($input);
        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $result = $this->getProvider()->get($input);

        $cacheItem
            ->set($result)
            ->expiresAt(
                (new DateTime())->modify('+1 day')
            );

        return $result;

    }

    public function getCacheKey(array $input)
    {
        return json_encode($input);
    }
}