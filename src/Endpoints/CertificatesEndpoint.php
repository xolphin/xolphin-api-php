<?php

namespace Xolphin\Endpoints;

use Exception;
use Xolphin\Client;
use Xolphin\Exceptions\XolphinRequestException;
use Xolphin\Requests\ReissueRequest;
use Xolphin\Requests\RenewRequest;
use Xolphin\Responses\Base;
use Xolphin\Responses\Certificate;
use Xolphin\Responses\Certificates;
use Xolphin\Responses\Request;

class CertificatesEndpoint
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
     * @throws Exception
     */
    public function all(): array
    {
        $certificates = [];

        $result = new Certificates($this->client->get('certificates', ['page' => 1]));
        if (!$result->isError()) {
            $certificates = $result->certificates;
            while ($result->page < $result->pages) {
                $result = new Certificates($this->client->get('certificates', ['page' => $result->page + 1]));
                if ($result->isError()) {
                    break;
                }
                $certificates = array_merge($certificates, $result->certificates);
            }
        }

        return $certificates;
    }


    /**
     * @param int $id
     * @return Certificate
     * @throws XolphinRequestException
     * @throws Exception
     */
    public function get(int $id): Certificate
    {
        return new Certificate($this->client->get('certificates/' . $id));
    }


    /**
     * @param int $id
     * @param string $format
     * @return string
     * @throws XolphinRequestException
     */
    public function download(int $id, string $format = 'CRT')
    {
        $response = $this->client->download('certificates/' . $id . '/download', [
            'format' => $format
        ]);

        return $response->getContents();
    }


    /**
     * @param int $id
     * @param ReissueRequest $reissue
     * @return Request
     * @throws XolphinRequestException
     * @throws Exception
     */
    public function reissue(int $id, ReissueRequest $reissue): Request
    {
        return new Request($this->client->post('certificates/' . $id . '/reissue', $reissue->getApiRequestBody()));
    }


    /**
     * @param int $id
     * @param RenewRequest $renew
     * @return Request
     * @throws XolphinRequestException
     * @throws Exception
     */
    public function renew(int $id, RenewRequest $renew): Request
    {
        return new Request($this->client->post('certificates/' . $id . '/renew', $renew->getApiRequestBody()));
    }


    /**
     * @param int $id
     * @param string $reason
     * @param bool $revoke
     * @return Base
     * @throws XolphinRequestException
     */
    public function cancel(int $id, string $reason, bool $revoke = false): Base
    {
        return new Base($this->client->post('certificates/' . $id . '/cancel', [
            'reason' => $reason,
            'revoke' => $revoke
        ]));
    }
}