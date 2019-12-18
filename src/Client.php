<?php

namespace Xolphin;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\StreamInterface;
use Xolphin\Endpoints\CertificatesEndpoint;
use Xolphin\Endpoints\InvoicesEndpoint;
use Xolphin\Endpoints\RequestsEndpoint;
use Xolphin\Endpoints\SupportEndpoint;
use Xolphin\Exceptions\XolphinRequestException;

class Client
{

    const BASE_URI = 'https://api.xolphin.com/v%d/';
    const BASE_URI_TEST = 'https://test-api.xolphin.com/v%d/';
    const API_VERSION = 1;
    const VERSION = '2.0.0';

    private $username = '';
    private $password = '';
    private $guzzle;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $requestsRemaining;

    /**
     * @var CertificatesEndpoint
     */
    public $certificates;

    /**
     * @var InvoicesEndpoint
     */
    public $invoices;

    /**
     * @var RequestsEndpoint
     */
    public $requests;

    /**
     * @var SupportEndpoint
     */
    public $support;


    /**
     * Client constructor.
     * @param $username
     * @param $password
     * @param bool $test
     */
    function __construct($username, $password, $test = false)
    {
        $this->username = $username;
        $this->password = $password;

        $this->limit = 1;
        $this->requestsRemaining = 1;

        $options = [
            'base_uri' => sprintf(($test ? Client::BASE_URI_TEST : Client::BASE_URI), Client::API_VERSION),
            'auth' => [$this->username, $this->password],
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'xolphin-api-php/' . Client::VERSION
            ]
        ];
        if (getenv('TEST_PROXY') !== false) {
            $options['proxy'] = getenv('TEST_PROXY');
            $options['verify'] = false;
        }
        $this->guzzle = new \GuzzleHttp\Client($options);

        $this->initializeEndpoints();
    }

    public function initializeEndpoints()
    {
        $this->certificates = new CertificatesEndpoint($this);
        $this->invoices = new InvoicesEndpoint($this);
        $this->requests = new RequestsEndpoint($this);
        $this->support = new SupportEndpoint($this);
    }

    /**
     * @return SupportEndpoint
     * @deprecated Use $client->support instead
     */
    public function support()
    {
        return $this->support;
    }

    /**
     * @return InvoicesEndpoint
     * @deprecated Use $client->invoices instead
     */
    public function invoice()
    {
        return $this->invoices;
    }

    /**
     * @return CertificatesEndpoint
     * @deprecated Use $client->certificates instead
     */
    public function certificate()
    {
        return $this->certificates;
    }

    /**
     * @return RequestsEndpoint
     * @deprecated Use $client->requests instead
     */
    public function request()
    {
        return $this->requests;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getRequestsRemaining()
    {
        return $this->requestsRemaining;
    }


    /**
     * @param $method
     * @param array $data
     * @return mixed
     * @throws XolphinRequestException
     */
    public function get($method, $data = [])
    {
        try {
            $result = $this->guzzle->get($method, ['query' => $data]);
            $this->updateLimitAndRemaining($result->getHeader('X-RateLimit-Limit')[0],
                $result->getHeader('X-RateLimit-Remaining')[0]);
            return json_decode($result->getBody());
        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }


    /**
     * @param $method
     * @param array $data
     * @return mixed
     * @throws XolphinRequestException
     */
    public function post($method, $data = [])
    {
        try {
            $mp = [];
            foreach ($data as $k => $v) {
                if ($k == 'document') {
                    $mp[] = [
                        'name' => $k,
                        'contents' => $v,
                        'filename' => 'document.pdf'
                    ];
                } else {
                    $mp[] = [
                        'name' => $k,
                        'contents' => (string)$v
                    ];
                }
            }

            $result = $this->guzzle->post($method, ['multipart' => $mp]);
            $this->updateLimitAndRemaining($result->getHeader('X-RateLimit-Limit')[0],
                $result->getHeader('X-RateLimit-Remaining')[0]);
            return json_decode($result->getBody());
        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }

    /**
     * @param $method
     * @param array $data
     * @return StreamInterface
     * @throws XolphinRequestException
     */
    public function download($method, $data = [])
    {
        try {
            $result = $this->guzzle->get($method, ['query' => $data]);
            $this->updateLimitAndRemaining($result->getHeader('X-RateLimit-Limit')[0],
                $result->getHeader('X-RateLimit-Remaining')[0]);
            return $result->getBody();
        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }

    /**
     * @param $limit
     * @param $remaining
     */
    public function updateLimitAndRemaining($limit, $remaining)
    {
        $this->limit = $limit;
        $this->requestsRemaining = $remaining;
    }
}
