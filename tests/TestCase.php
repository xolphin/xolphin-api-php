<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Xolphin\Client;

class TestCase extends BaseTestCase
{
    /**
     * @var Client
     */
    public Client $_client;

    /**
     * @description "Initialize function before test run"
     */
    protected function setUp(): void
    {
        $this->_client = new Client('youremail@domain.com', 'YourPassword', true);
    }
}
