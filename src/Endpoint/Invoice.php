<?php

namespace Xolphin\Endpoint;

use Exception;
use Xolphin\Client;
use Xolphin\Responses\Invoices;

class Invoice {
    /**
     * @var Client
     */
    private $client;

    /**
     * Requests constructor.
     * @param Client $client
     */
    function __construct($client) {
        $this->client = $client;
    }

    /**
     * @return \Xolphin\Responses\Invoice[]
     * @throws Exception
     */
    public function all() {
        $invoices = [];

        $result = new Invoices($this->client->get('invoices', ['page' => 1]));
        if(!$result->isError()) {
            $invoices = $result->invoices;
            while($result->page < $result->pages) {
                $result = new Invoices($this->client->get('invoices', ['page' => $result->page + 1]));
                if($result->isError()) break;
                $invoices = array_merge($invoices, $result->invoices);
            }
        }

        return $invoices;
    }

    /**
     * @param $id
     * @return \Xolphin\Responses\Invoice
     * @throws Exception
     */
    public function get($id) {
        return new \Xolphin\Responses\Invoice($this->client->get('invoices/' . $id));
    }

    /**
     * @param $id
     * @param string $format
     * @return mixed
     * @throws Exception
     */
    public function download($id, $format = 'PDF') {
        return $this->client->get('invoices/' . $id . '/download?type=' . $format);
    }
}