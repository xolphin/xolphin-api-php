<?php

namespace Tests;

use Xolphin\Client;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @var Client
     */
    public $_client;

    /**
     * @description "Initialize function before test run"
     */
    protected function setUp(): void
    {
        $this->_client = new Client('youremail@domain.com', 'YourPassword', true);
    }

}
