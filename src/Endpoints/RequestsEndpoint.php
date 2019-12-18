<?php

namespace Xolphin\Endpoints;

use DateTime;
use Xolphin\Client;
use Xolphin\Exceptions\XolphinRequestException;
use Xolphin\Requests\CertificateRequest;
use Xolphin\Requests\RequestEERequest;
use Xolphin\Responses\Base;
use Xolphin\Responses\Notes;
use Xolphin\Responses\Request;
use Xolphin\Responses\RequestEE;
use Xolphin\Responses\Requests;
use Xolphin\Responses\ValidationCalls;

class RequestsEndpoint
{
    /**
     * @var Client
     */
    private $client;

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
     */
    public function all(): array
    {
        $requests = [];

        $result = new Requests($this->client->get('requests', ['page' => 1]));
        if (!$result->isError()) {
            $requests = $result->requests;
            while ($result->page < $result->pages) {
                $result = new Requests($this->client->get('requests', ['page' => $result->page + 1]));
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
     */
    public function send(CertificateRequest $request): Request
    {
        return new Request($this->client->post('requests', $request->getApiRequestBody()));
    }


    /**
     * @return RequestEERequest
     */
    public function createEE(): RequestEERequest
    {
        return new RequestEERequest();
    }


    /**
     * @param RequestEERequest $request
     * @return RequestEE
     * @throws XolphinRequestException
     */
    public function sendEE(RequestEERequest $request): RequestEE
    {
        return new RequestEE($this->client->post('requests/ee', $request->getApiRequestBody()));
    }


    /**
     * @param int $id
     * @return Request
     * @throws XolphinRequestException
     */
    public function get(int $id): Request
    {
        return new Request($this->client->get('requests/' . $id));
    }


    /**
     * @param int $id
     * @param string $document
     * @param string $description
     * @return Base
     * @throws XolphinRequestException
     */
    public function upload(int $id, string $document, string $description = ''): Base
    {
        return new Base($this->client->post('requests/' . $id . '/upload-document', [
            'document' => $document,
            'description' => $description
        ]));
    }


    /**
     * @param int $id
     * @param string $domain
     * @param string $dcvType
     * @param string $email
     * @return Base
     * @throws XolphinRequestException
     */
    public function retryDCV(int $id, string $domain, string $dcvType, string $email = ''): Base
    {
        return new Base($this->client->post('requests/' . $id . '/retry-dcv', [
            'domain' => $domain,
            'dcvType' => $dcvType,
            'email' => $email
        ]));
    }


    /**
     * @param int $id
     * @param DateTime $dateTime
     * @param string $timezone
     * @return Base
     * @throws XolphinRequestException
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
     * @throws XolphinRequestException
     */
    public function sendNote(int $id, string $note, bool $endCustomer = false): Base
    {
        return new Base($this->client->post('requests/' . $id . '/notes',
            [
                'message' => $note,
                'endCustomer' => $endCustomer
            ])
        );
    }


    /**
     * @param int $id
     * @param string $to
     * @param string|null $language
     * @return Base
     * @throws XolphinRequestException
     */
    public function sendSectigoSAEmail(int $id, string $to, string $language = null): Base
    {
        return new Base(
            $this->client->post(
                'requests/' . $id . '/sa',
                [
                    'sa_email' => $to,
                    'language' => $language
                ]
            )
        );
    }


    /**
     * @param int $id
     * @param string $reason
     * @return Base
     * @throws XolphinRequestException
     */
    public function cancel(int $id, string $reason = ''): Base
    {
        return new Base($this->client->post('requests/' . $id . '/cancel', [
            'reason' => $reason
        ]));
    }
}