<?php

namespace Xolphin\Endpoint;

use Exception;
use Xolphin\Client;
use Xolphin\Responses\Base;
use Xolphin\Responses\Notes;
use Xolphin\Responses\Requests;
use Xolphin\Responses\ValidationCalls;

class Request {
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
     * @return \Xolphin\Responses\Request[]
     * @throws Exception
     */
    public function all() {
        $requests = [];

        $result = new Requests($this->client->get('requests', ['page' => 1]));
        if(!$result->isError()) {
            $requests = $result->requests;
            while($result->page < $result->pages) {
                $result = new Requests($this->client->get('requests', ['page' => $result->page + 1]));
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
     * @throws Exception
     */
    public function send($request) {
        return new \Xolphin\Responses\Request($this->client->post('requests', $request->getArray()));
    }

    /**
     * @return \Xolphin\Requests\RequestEE
     */
    public function createEE(){
        return new \Xolphin\Requests\RequestEE();
    }

    /**
     * @param \Xolphin\Requests\RequestEE $request
     * @return \Xolphin\Responses\RequestEE
     * @throws Exception
     */
    public function sendEE($request){
        return new \Xolphin\Responses\RequestEE($this->client->post('requests/ee', $request->getArray()));
    }

    /**
     * @param int $id
     * @return \Xolphin\Responses\Request
     * @throws Exception
     */
    public function get($id) {
        return new \Xolphin\Responses\Request($this->client->get('requests/' . $id));
    }

    /**
     * @param int $id
     * @param mixed $document
     * @param string $description
     * @return Base
     * @throws Exception
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
     * @throws Exception
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
     * @param string $timezone
     * @return Base
     * @throws Exception
     */
    public function scheduleValidationCall($id, \DateTime $dateTime, $timezone = 'Europe/Amsterdam') {
        return new Base($this->client->post('requests/' . $id . '/schedule-validation-call', [
            'date'      => $dateTime->format('Y-m-d'),
            'time'      => $dateTime->format('H:i'),
            'timezone'  => $timezone
        ]));
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getScheduleValidationCall($id)
    {
        $list = [];
        $result =  new ValidationCalls($this->client->get('requests/' . $id . '/validation-calls'));
        if(!$result->isError()) {
            $list = $result->validationCall;
        }
        return $list;
    }

    /**
     * Gets all messages for a given request ID
     *
     * @param $id
     * @return array
     * @throws Exception
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
     * @param bool $endCustomer
     * @return Base
     * @throws Exception
     */
    public function sendNote($id, $note, $endCustomer = false){
        return new Base($this->client->post('requests/' . $id . '/notes',
            [
                'message'       => $note,
                'endCustomer'   => $endCustomer
            ])
        );
    }

    /**
     * Sends a Comodo Subscriber Agreement email
     *
     * @param $id
     * @param $to
     * @param $language (currently available: en, de, fr, nl)
     * @return Base
     * @throws Exception
     * @deprecated use sendSectigoSAEmail() instead
     */
    public function sendComodoSAEmail($id, $to, $language = null){
        return $this->sendSectigoSAEmail($id, $to, $language);
    }

    /**
     * Sends a Sectigo Subscriber Agreement email
     *
     * @param $id
     * @param $to
     * @param $language (currently available: en, de, fr, nl)
     * @return Base
     * @throws Exception
     */
    public function sendSectigoSAEmail($id, $to, $language = null){
        return new Base($this->client->post('requests/' . $id . '/sa',['sa_email' => $to, 'language' => $language]));
    }

    /**
     * Cancel a certificate request.
     *
     * @param $id
     * @param string $reason
     * @return Base
     * @throws Exception
     */
    public function cancel($id, $reason = '')
    {
        return new Base($this->client->post('requests/' . $id . '/cancel', [
            'reason' => $reason
        ]));
    }
}
