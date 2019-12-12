<?php

namespace Xolphin\Responses;

class Invoices extends Base {
    /** @var Invoice[]  */
    public $invoices = [];

    /**
     * Requests constructor.
     * @param object $data
     * @throws \Exception
     */
    function __construct($data) {
        parent::__construct($data);

        if(!$this->isError()) {
            foreach($this->_embedded->invoices as $invoice) {
                $this->invoices[] = new Invoice($invoice);
            }
        }
    }
}