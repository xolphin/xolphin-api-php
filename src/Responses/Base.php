<?php

namespace Xolphin\Responses;

class Base {
    /** @var string */
    private $message;
    /** @var mixed */
    private $errors;

    /** @var int */
    public $page;
    /** @var int */
    public $limit;
    /** @var int */
    public $pages;
    /** @var int */
    public $total;

    /** @var object */
    protected $_embedded;

    /**
     * BaseResponse constructor.
     * @param object $data
     */
    public function __construct($data) {
        if(!empty($data->message)) $this->message = $data->message;
        if(!empty($data->errors)) $this->errors = $data->errors;
        if(!empty($data->page)) $this->page = $data->page;
        if(!empty($data->limit)) $this->limit = $data->limit;
        if(!empty($data->pages)) $this->pages = $data->pages;
        if(!empty($data->total)) $this->total = $data->total;
        if(!empty($data->_embedded)) $this->_embedded = $data->_embedded;
    }

    /**
     * @return bool
     */
    public function isError() {
        return empty($this->message)?FALSE:TRUE;
    }

    /**
     * @return string
     */
    public function getErrorMessage() {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getErrorData() {
        return $this->errors;
    }
}