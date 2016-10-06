<?php

namespace Xolphin\Endpoint;

use Xolphin\Client;
use Xolphin\Responses\Base;
use Xolphin\Responses\Note;
use Xolphin\Responses\Notes;

class Request {
    private $client;

    /**
     * Requests constructor.
     * @param Client $client
     */
    function __construct($client) {
        $this->client = $client;
    }

    /**
     * @return \Xolphin\Responses\Request[]
     */
    public function all() {
        $requests = [];

        $result = new \Xolphin\Responses\Requests($this->client->get('requests', ['page' => 1]));
        if(!$result->isError()) {
            $requests = $result->requests;
            while($result->page < $result->pages) {
                $result = new \Xolphin\Responses\Requests($this->client->get('requests', ['page' => $result->page + 1]));
                if($result->isError()) break;
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
     * @return \Xolphin\Requests\Request
     */
    public function create($product, $years, $csr, $dcvType) {
        return new \Xolphin\Requests\Request($product, $years, $csr, $dcvType);
    }

    /**
     * @param \Xolphin\Requests\Request $request
     * @return \Xolphin\Responses\Request
     */
    public function send($request) {
        return new \Xolphin\Responses\Request($this->client->post('requests', $request->getArray()));
    }

    /**
     * @param itn $id
     * @return \Xolphin\Responses\Request
     */
    public function get($id) {
        return new \Xolphin\Responses\Request($this->client->get('requests/' . $id));
    }

    /**
     * @param int $id
     * @param mixed $document
     * @param string $description
     * @return Base
     */
    public function upload($id, $document, $description = '') {
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
     */
    public function retryDCV($id, $domain, $dcvType, $email = '') {
        return new Base($this->client->post('requests/' . $id . '/retry-dcv', [
            'domain' => $domain,
            'dcvType' => $dcvType,
            'email' => $email
        ]));
    }

    /**
     * @param int $id
     * @param \DateTime $dateTime
     * @return Base
     */
    public function scheduleValidationCall($id, \DateTime $dateTime) {
        return new Base($this->client->post('requests/' . $id . '/schedule-validation-call', [
            'date' => $dateTime->format('Y-m-d'),
            'time' => $dateTime->format('H:i')
        ]));
    }

    /**
     * Gets all messages for a given request ID
     *
     * @param $id
     * @return Note
     */
    public function getNotes($id){

        $messages = [];

        $result =  new Notes($this->client->get('requests/' . $id . '/notes'));
        if(!$result->isError()) {
            $messages = $result->notes;
        }
        return $messages;
    }

    /**
     * Creates a new message for a given request ID
     *
     * @param $id
     * @param $note
     * @return Base
     */
    public function sendNote($id, $note){
        return new Base($this->client->post('requests/' . $id . '/notes',['message' => $note]));
    }

    /**
     * Sends a Comodo Subscriber Agreement email
     *
     * @param $id
     * @param $to
     * @param $language (currently available: en, de, fr, nl)
     * @return Base
     */
    public function sendComodoSAEmail($id, $to, $language = null){
        return new Base($this->client->post('requests/' . $id . '/sa',['sa_email' => $to, 'language' => $language]));
    }
}