<?php

namespace Tests;

use Xolphin\Client;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public $_client;

    /**
     * @description "Initialize function before test run"
     */
    public function setUp()
    {
        $this->_client = new Client('fake_login@xolphin.api', 'Sup3rSecre7P@s$w0rdForThe@p1', true);
    }

}