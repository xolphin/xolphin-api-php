<?php

namespace Xolphin;

use GuzzleHttp\Exception\RequestException;
use Xolphin\Endpoint\Certificate;
use Xolphin\Endpoint\Request;
use Xolphin\Endpoint\Support;
use Xolphin\Exception\XolphinRequestException;

class Client {
    const BASE_URI = 'https://api.xolphin.com/v%d/';
    const BASE_URI_TEST = 'https://test-api.xolphin.com/v%d/';
    const API_VERSION = 1;
    const VERSION = '1.6.0';

    private $username = '';
    private $password = '';
    private $guzzle;

    /**
     * Client constructor.
     * @param string $username
     * @param string $password
     * @param boolean $test|false
     */
    function __construct($username, $password, $test=false) {
        $this->username = $username;
        $this->password = $password;

        $options = [
            'base_uri' => sprintf(($test ? Client::BASE_URI_TEST : Client::BASE_URI), Client::API_VERSION),
            'auth' => [$this->username, $this->password],
            'headers' => [
                'Accept'     => 'application/json',
                'User-Agent' => 'xolphin-api-php/'. Client::VERSION
            ]
        ];
        if(getenv('TEST_PROXY') !== FALSE) {
            $options['proxy'] = getenv('TEST_PROXY');
            $options['verify'] = false;
        }
        $this->guzzle = new \GuzzleHttp\Client($options);
    }

    /**
     * @param string $method
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function get($method, $data = []) {
        try {
            $result = $this->guzzle->get($method, ['query' => $data]);
            return json_decode($result->getBody());
        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }

    /**
     * @param string $method
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function post($method, $data = []) {
        try {
            $mp = [];
            foreach($data as $k => $v) {
                if($k == 'document') {
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
            return json_decode($result->getBody());
        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }

    /**
     * @param string $method
     * @param array $data
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Exception
     */
    public function download($method, $data = []) {
        try {
            $result = $this->guzzle->get($method, ['query' => $data]);
            return $result->getBody();
        } catch (RequestException $e) {
            throw XolphinRequestException::createFromRequestException($e);
        }
    }

    /**
     * @return Request
     */
    public function request() {
        return new Request($this);
    }

    /**
     * @return Certificate
     */
    public function certificate() {
        return new Certificate($this);
    }

    /**
     * @return Support
     */
    public function support() {
        return new Support($this);
    }
}
