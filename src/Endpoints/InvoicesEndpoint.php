<?php

namespace Xolphin\Endpoints;

use Xolphin\Client;
use Xolphin\Exceptions\XolphinRequestException;
use Xolphin\Responses\Invoice;
use Xolphin\Responses\Invoices;

class InvoicesEndpoint
{
    /**
     * @var Client
     */
    private $client;


    /**
     * InvoicesEndpoint constructor.
     * @param Client $client
     */
    function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @return array
     * @throws XolphinRequestException
     */
    public function all(): array
    {
        $invoices = [];

        $result = new Invoices($this->client->get('invoices', ['page' => 1]));
        if (!$result->isError()) {
            $invoices = $result->invoices;
            while ($result->page < $result->pages) {
                $result = new Invoices($this->client->get('invoices', ['page' => $result->page + 1]));
                if ($result->isError()) {
                    break;
                }
                $invoices = array_merge($invoices, $result->invoices);
            }
        }

        return $invoices;
    }


    /**
     * @param int $id
     * @return Invoice
     * @throws XolphinRequestException
     */
    public function get(int $id): Invoice
    {
        return new Invoice($this->client->get('invoices/' . $id));
    }

    /**
     * @param int $id
     * @param string $format
     * @return string
     * @throws XolphinRequestException
     */
    public function download(int $id, string $format = 'PDF'): string
    {
        $response = $this->client->download(
            'invoices/' . $id . '/download',
                [
                    'type' => $format,
                ]
            );
        return $response->getContents();
    }
}