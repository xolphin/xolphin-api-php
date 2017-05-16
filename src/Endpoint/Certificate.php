<?php

namespace Xolphin\Endpoint;

use Xolphin\Client;
use Xolphin\Requests\Reissue;
use Xolphin\Requests\Renew;
use Xolphin\Responses\Base;

class Certificate {
    /**
     * @var Client
     */
    private $client;

    /**
     * Requests constructor.
     * @param Client $client
     */
    function __construct($client) {
        $this->client = $client;
    }

    /**
     * @return \Xolphin\Responses\Certificate[]
     */
    public function all() {
        $certificates = [];

        $result = new \Xolphin\Responses\Certificates($this->client->get('certificates', ['page' => 1]));
        if(!$result->isError()) {
            $certificates = $result->certificates;
            while($result->page < $result->pages) {
                $result = new \Xolphin\Responses\Certificates($this->client->get('certificates', ['page' => $result->page + 1]));
                if($result->isError()) break;
                $certificates = array_merge($certificates, $result->certificates);
            }
        }

        return $certificates;
    }

    /**
     * @param int $id
     * @return \Xolphin\Responses\Certificate
     */
    public function get($id) {
        return new \Xolphin\Responses\Certificate($this->client->get('certificates/' . $id));
    }

    /**
     * @param int $id
     * @param string $format
     * @return mixed
     */
    public function download($id, $format = 'CRT') {
        return $this->client->download('certificates/' . $id . '/download', [
            'format' => $format
        ]);
    }

    /**
     * @param int $id
     * @param Reissue $request
     * @return Request
     */
    public function reissue($id, $request) {
        return new \Xolphin\Responses\Request($this->client->post('certificates/' . $id . '/reissue', $request->getArray()));
    }

    /**
     * @param int $id
     * @param Renew $request
     * @return Request
     */
    public function renew($id, $request) {
        return new \Xolphin\Responses\Request($this->client->post('certificates/' . $id . '/renew', $request->getArray()));
    }

    public function cancel($id, $reason, $revoke = FALSE) {
        return new Base($this->client->post('certificates/' . $id . '/cancel', [
            'reason' => $reason,
            'revoke' => $revoke
        ]));
    }
}
