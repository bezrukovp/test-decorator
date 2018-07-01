<?php

namespace src\Test;


use src\Decorator\CacheDecorator;
use src\Decorator\LogDecorator;
use src\Integration\DataProvider;
use Cache\Adapter\PHPArray\ArrayCachePool;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class DataFetchTest
{
    public function testRequest()
    {
        $host = 'localhost';
        $user = 'admin';
        $password = 'admin';

        $provider = new DataProvider($host,$user, $password);

        $pool = new ArrayCachePool();
        $provider = new CacheDecorator($provider);
        $provider->setCacheItemPool($pool);

        $logger = new Logger('test');
        $logger->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

        $provider = new LogDecorator($provider);
        $provider->setLogger($logger);

        $provider->get([]);


    }

}