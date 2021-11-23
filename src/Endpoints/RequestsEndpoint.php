<?php

declare(strict_types=1);

namespace Xolphin\Endpoints;

use DateTime;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Xolphin\Client;
use Xolphin\Exceptions\XolphinRequestException;
use Xolphin\Requests\CertificateRequest;
use Xolphin\Responses\Base;
use Xolphin\Responses\Notes;
use Xolphin\Responses\Request;
use Xolphin\Responses\Requests;
use Xolphin\Responses\ValidationCalls;

class RequestsEndpoint
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * Requests constructor.
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
        $requests = [];

        $result = new Requests($this->client->get('requests', ['page' => 1]));
        if (!$result->isError()) {
            $requests = $result->requests;
            while ($result->getPagination()->getPage() < $result->getPagination()->getPages()) {
                $result = new Requests($this->client->get('requests', ['page' => $result->getPagination()->getPage() + 1]));

                if ($result->isError()) {
                    break;
                }

                $requests = array_merge($requests, $result->requests);
            }
        }

        return $requests;
    }

    /**
     * @param int $product
     * @param int $years
     * @param string $csr
     * @param string $dcvType
     * @return CertificateRequest
     */
    public function create(int $product, int $years, string $csr, string $dcvType): CertificateRequest
    {
        return new CertificateRequest($product, $years, $csr, $dcvType);
    }

    /**
     * @param CertificateRequest $request
     * @return Request
     * @throws XolphinRequestException
     * @throws Exception|GuzzleException
     */
    public function send(CertificateRequest $request): Request
    {
        return new Request($this->client->post('requests', $request->getApiRequestBody()));
    }

    /**
     * @param int $id
     * @return Request
     * @throws XolphinRequestException
     * @throws Exception|GuzzleException
     */
    public function get(int $id): Request
    {
        return new Request($this->client->get('requests/' . $id));
    }

    /**
     * @param int $id
     * @param string $document
     * @param string|null $description
     * @return Base
     * @throws XolphinRequestException|GuzzleException
     */
    public function upload(int $id, string $document, ?string $description = null): Base
    {
        return new Base($this->client->post('requests/' . $id . '/upload-document', [
            'document' => $document,
            'description' => $description ?? ''
        ]));
    }

    /**
     * @param int $id
     * @param string $domain
     * @param string $dcvType
     * @param string|null $email
     * @return Base
     * @throws XolphinRequestException|GuzzleException
     */
    public function retryDCV(int $id, string $domain, string $dcvType, ?string $email = null): Base
    {
        return new Base($this->client->post('requests/' . $id . '/retry-dcv', [
            'domain' => $domain,
            'dcvType' => $dcvType,
            'email' => $email ?? ''
        ]));
    }

    /**
     * @param int $id
     * @param DateTime $dateTime
     * @param string $timezone
     * @return Base
     * @throws XolphinRequestException|GuzzleException
     */
    public function scheduleValidationCall(int $id, DateTime $dateTime, string $timezone = 'Europe/Amsterdam'): Base
    {
        return new Base($this->client->post('requests/' . $id . '/schedule-validation-call', [
            'date' => $dateTime->format('Y-m-d'),
            'time' => $dateTime->format('H:i'),
            'timezone' => $timezone
        ]));
    }

    /**
     * @param int $id
     * @return array
     * @throws XolphinRequestException
     * @throws Exception|GuzzleException
     */
    public function getScheduleValidationCall(int $id): array
    {
        $list = [];
        $result = new ValidationCalls($this->client->get('requests/' . $id . '/validation-calls'));
        if (!$result->isError()) {
            $list = $result->validationCall;
        }
        return $list;
    }

    /**
     * @param int $id
     * @return array
     * @throws XolphinRequestException
     * @throws Exception|GuzzleException
     */
    public function getNotes(int $id): array
    {
        $messages = [];

        $result = new Notes($this->client->get('requests/' . $id . '/notes'));
        if (!$result->isError()) {
            $messages = $result->notes;
        }
        return $messages;
    }


    /**
     * @param int $id
     * @param string $note
     * @param bool $endCustomer
     * @return Base
     * @throws XolphinRequestException|GuzzleException
     */
    public function sendNote(int $id, string $note, bool $endCustomer = false): Base
    {
        return new Base($this->client->post('requests/' . $id . '/notes', [
            'message' => $note,
            'endCustomer' => $endCustomer
        ]));
    }

    /**
     * @param int $id
     * @param string $to
     * @param string|null $language
     * @return Base
     * @throws XolphinRequestException|GuzzleException
     */
    public function sendSectigoSAEmail(int $id, string $to, ?string $language = null): Base
    {
        return new Base($this->client->post('requests/' . $id . '/sa', [
            'sa_email' => $to,
            'language' => $language ?? ''
        ]));
    }

    /**
     * @param int $id
     * @param string|null $reason
     * @return Base
     * @throws XolphinRequestException|GuzzleException
     */
    public function cancel(int $id, ?string $reason = null): Base
    {
        return new Base($this->client->post('requests/' . $id . '/cancel', [
            'reason' => $reason ?? ''
        ]));
    }
}