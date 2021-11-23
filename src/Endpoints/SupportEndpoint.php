<?php

declare(strict_types=1);

namespace Xolphin\Endpoints;

use GuzzleHttp\Exception\GuzzleException;
use Xolphin\Client;
use Xolphin\Exceptions\XolphinRequestException;
use Xolphin\Responses\CSR;
use Xolphin\Responses\Product;
use Xolphin\Responses\Products;
use Xolphin\Responses\SSLCheck;

class SupportEndpoint
{
    /**
     * @var Client
     */
    private Client $client;

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
     * @throws XolphinRequestException|GuzzleException
     */
    public function approverEmailAddresses(string $domain): array
    {
        return $this->client->get('approver-email-addresses', ['domain' => $domain]);
    }

    /**
     * @param string $csr
     * @return CSR
     * @throws XolphinRequestException|GuzzleException
     */
    public function decodeCSR(string $csr): CSR
    {
        return new CSR($this->client->post('decode-csr', ['csr' => $csr]));
    }

    /**
     * @return array
     * @throws XolphinRequestException|GuzzleException
     */
    public function products(): array
    {
        $products = [];

        $result = new Products($this->client->get('products', ['page' => 1]));
        if (!$result->isError()) {
            $products = $result->products;
            while ($result->getPagination()->getPage() < $result->getPagination()->getPages()) {
                $result = new Products($this->client->get('products', ['page' => $result->getPagination()->getPage() + 1]));

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
     * @throws XolphinRequestException|GuzzleException
     */
    public function product(int $id): Product
    {
        return new Product($this->client->get('products/' . $id));
    }

    /**
     * @param string $domain
     * @return SSLCheck
     * @throws XolphinRequestException|GuzzleException
     */
    public function sslcheck(string $domain): SSLCheck
    {
        return new SSLCheck($this->client->get('ssl-check', ['domain' => $domain]));
    }
}