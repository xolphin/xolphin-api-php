<?php

namespace Xolphin\Endpoint;

use Exception;
use Xolphin\Responses\CSR;
use Xolphin\Responses\Product;
use Xolphin\Responses\Products;
use Xolphin\Client;
use Xolphin\Responses\SSLCheck;

class Support {
    private $client;

    /**
     * Products constructor.
     * @param Client $client
     */
    function __construct($client) {
        $this->client = $client;
    }

    /**
     * @param string $domain
     * @return string[]
     * @throws Exception
     */
    public function approverEmailAddresses($domain) {
        return $this->client->get('approver-email-addresses', ['domain' => $domain]);
    }

    /**
     * @param string $csr
     * @return CSR
     * @throws Exception
     */
    public function decodeCSR($csr) {
        return new CSR($this->client->post('decode-csr', ['csr' => $csr]));
    }

    /**
     * @return Product[]
     * @throws Exception
     */
    public function products() {
        $products = [];

        $result = new Products($this->client->get('products', ['page' => 1]));
        if(!$result->isError()) {
            $products = $result->products;
            while($result->page < $result->pages) {
                $result = new Products($this->client->get('products', ['page' => $result->page + 1]));
                if($result->isError()) break;
                $products = array_merge($products, $result->products);
            }
        }
        return $products;
    }

    /**
     * @param int $id
     * @return Product
     * @throws Exception
     */
    public function product($id) {
        return new Product($this->client->get('products/' . $id));
    }

    /**
     * @param $domain
     * @return SSLCheck
     * @throws Exception
     */
    public function sslcheck($domain) {
        return new SSLCheck($this->client->get('ssl-check', ['domain' => $domain]));
    }
}
