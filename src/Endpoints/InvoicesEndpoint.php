<?php

declare(strict_types=1);

namespace Xolphin\Endpoints;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Xolphin\Client;
use Xolphin\Exceptions\XolphinRequestException;
use Xolphin\Responses\Invoice;
use Xolphin\Responses\Invoices;

class InvoicesEndpoint
{
    /**
     * @var Client
     */
    private Client $client;

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
     * @throws Exception|GuzzleException
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
     * @throws Exception|GuzzleException
     */
    public function get(int $id): Invoice
    {
        return new Invoice($this->client->get('invoices/' . $id));
    }

    /**
     * @param int $id
     * @param string $format
     * @return string
     * @throws XolphinRequestException|GuzzleException
     */
    public function download(int $id, string $format = 'PDF'): string
    {
        $response = $this->client->download('invoices/' . $id . '/download', [
            'type' => $format,
        ]);

        return $response->getContents();
    }
}