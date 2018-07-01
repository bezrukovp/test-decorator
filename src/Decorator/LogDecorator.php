<?php

namespace src\Decorator;

use Exception;
use Psr\Log\LoggerInterface;

class LogDecorator extends AbstractDecorator
{
    private $logger;


    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function get(array $input)
    {
        try {

            $result = $this->getProvider()->get($input);

            return $result;
        } catch (Exception $e) {
            $this->logger->critical('Error');
        }

        return [];

    }
}