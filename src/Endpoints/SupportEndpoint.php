<?php

namespace Xolphin\Endpoints;

use Xolphin\Exceptions\XolphinRequestException;
use Xolphin\Responses\CSR;
use Xolphin\Responses\Product;
use Xolphin\Responses\Products;
use Xolphin\Client;
use Xolphin\Responses\SSLCheck;

class SupportEndpoint
{
    /**
     * @var Client
     */
    private $client;

    /**
     * SupportEndpoint constructor.
     * @param Client $client
     */
    function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $domain
     * @return array
     * @throws XolphinRequestException
     */
    public function approverEmailAddresses(string $domain): array
    {
        return $this->client->get('approver-email-addresses', ['domain' => $domain]);
    }

    /**
     * @param string $csr
     * @return CSR
     * @throws XolphinRequestException
     */
    public function decodeCSR(string $csr): CSR
    {
        return new CSR($this->client->post('decode-csr', ['csr' => $csr]));
    }

    /**
     * @return array
     * @throws XolphinRequestException
     */
    public function products(): array
    {
        $products = [];

        $result = new Products($this->client->get('products', ['page' => 1]));
        if (!$result->isError()) {
            $products = $result->products;
            while ($result->page < $result->pages) {
                $result = new Products($this->client->get('products', ['page' => $result->page + 1]));
                if ($result->isError()) {
                    break;
                }
                $products = array_merge($products, $result->products);
            }
        }
        return $products;
    }

    /**
     * @param int $id
     * @return Product
     * @throws XolphinRequestException
     */
    public function product(int $id): Product
    {
        return new Product($this->client->get('products/' . $id));
    }

    /**
     * @param string $domain
     * @return SSLCheck
     * @throws XolphinRequestException
     */
    public function sslcheck(string $domain): SSLCheck
    {
        return new SSLCheck($this->client->get('ssl-check', ['domain' => $domain]));
    }
}