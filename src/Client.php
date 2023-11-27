<?php

declare(strict_types=1);

namespace Xolphin;

use GuzzleHttp\Exception\GuzzleException;
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
    const VERSION = '3.0.4';

    /** @var CertificatesEndpoint */
    public CertificatesEndpoint $certificates;

    /** @var InvoicesEndpoint */
    public InvoicesEndpoint $invoices;

    /** @var RequestsEndpoint $requests */
    public RequestsEndpoint $requests;

    /** @var SupportEndpoint $support */
    public SupportEndpoint $support;

    /** @var string|null $username */
    private ?string $username;

    /** @var string|null $password */
    private ?string $password;

    /** @var \GuzzleHttp\Client */
    private \GuzzleHttp\Client $guzzle;

    /** @var int */
    private int $limit;

    /** @var int */
    private int $requestsRemaining;

    /**
     * Client constructor.
     * @param string|null $username
     * @param string|null $password
     * @param bool $test
     */
    function __construct(?string $username = null, ?string $password = null, bool $test = false)
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

    public function initializeEndpoints(): void
    {
        $this->certificates = new CertificatesEndpoint($this);
        $this->invoices = new InvoicesEndpoint($this);
        $this->requests = new RequestsEndpoint($this);
        $this->support = new SupportEndpoint($this);
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getRequestsRemaining(): int
    {
        return $this->requestsRemaining;
    }

    /**
     * @param string $uri
     * @param array $data
     * @return mixed
     * @throws GuzzleException
     * @throws XolphinRequestException
     */
    public function get(string $uri, array $data = [])
    {
        try {
            $result = $this->guzzle->get($uri, ['query' => $data]);

            $this->updateLimitAndRemaining(
                (int) $result->getHeader('X-RateLimit-Limit')[0],
                (int) $result->getHeader('X-RateLimit-Remaining')[0]
            );

            return json_decode(
                $result->getBody()->getContents()
            );

        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }

    /**
     * @param string $uri
     * @param array $data
     * @return mixed
     * @throws XolphinRequestException|GuzzleException
     */
    public function post(string $uri, array $data = [])
    {
        try {
            $multipart = [];

            foreach ($data as $name => $content) {
                if ($name === 'document') {
                    $multipart[] = [
                        'name' => $name,
                        'contents' => $content,
                        'filename' => 'document.pdf'
                    ];
                } else {
                    $multipart[] = [
                        'name' => $name,
                        'contents' => (string) $content
                    ];
                }
            }

            $result = $this->guzzle->post($uri, ['multipart' => $multipart]);

            $this->updateLimitAndRemaining(
                (int) $result->getHeader('X-RateLimit-Limit')[0],
                (int) $result->getHeader('X-RateLimit-Remaining')[0]
            );

            return json_decode(
                $result->getBody()->getContents()
            );
        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }

    /**
     * @param string $uri
     * @param array $data
     * @return StreamInterface
     * @throws XolphinRequestException|GuzzleException
     */
    public function download(string $uri, array $data = []): StreamInterface
    {
        try {
            $result = $this->guzzle->get($uri, ['query' => $data]);

            $this->updateLimitAndRemaining(
                (int) $result->getHeader('X-RateLimit-Limit')[0],
                (int) $result->getHeader('X-RateLimit-Remaining')[0]
            );

            return $result->getBody();
        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }

    /**
     * @param int $limit
     * @param int $remaining
     */
    public function updateLimitAndRemaining(int $limit, int $remaining): void
    {
        $this->limit = $limit;
        $this->requestsRemaining = $remaining;
    }
}
