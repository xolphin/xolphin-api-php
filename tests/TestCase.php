<?php

namespace Tests;

use Xolphin\Client;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    public $_client;

    /**
     * @description "Initialize function before test run"
     */
    public function setUp()
    {
        $this->_client = new Client('youremail@domain.com', 'YourPassword', true);
    }

}
