<?php

namespace src\Decorator;


use src\Integration\DataProviderInterface;

abstract class AbstractDecorator implements DataProviderInterface
{
    private $provider;

    /**
     * CacheDecorator constructor.
     *
     * @param DataProviderInterface $provider
     */
    public function __construct(DataProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return DataProviderInterface
     */
    protected function getProvider(): DataProviderInterface
    {
        return $this->provider;
    }

}