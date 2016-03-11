<?php

namespace Xolphin\Responses;

class Requests extends Base {
    /** @var Request[]  */
    public $requests = [];

    /**
     * Requests constructor.
     * @param object $data
     */
    function __construct($data) {
        parent::__construct($data);

        if(!$this->isError()) {
            foreach($this->_embedded->requests as $request) {
                $this->requests[] = new Request($request);
            }
        }
    }
}