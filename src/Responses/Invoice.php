<?php

namespace Xolphin\Responses;

use Exception;

class Invoice extends Base {
    /** @var int */
    public $id;

    /** @var string */
    public $currency;

    /** @var float */
    public $amount;

    /** @var float */
    public $tax;

    /** @var int */
    public $invoiceNr;

    /** @var float */
    public $amountPaid;

    /** @var string */
    public $status;

    /** @var float */
    public $total;

    /** @var \DateTime */
    public $dateCreated;

    /** @var \DateTime */
    public $dateReminder;

    /** @var \DateTime */
    public $datePayed;

    /**
     * Request constructor.
     * @param object $data
     * @throws Exception
     */
    function __construct($data) {
        parent::__construct($data);

        if(!$this->isError()) {
            if(isset($data->id)) $this->id = $data->id;
            if (isset($data->currency)) $this->currency = $data->currency;
            if (isset($data->amount)) $this->amount = $data->amount;
            if (isset($data->tax)) $this->tax = $data->tax;
            if (isset($data->invoiceNr)) $this->invoiceNr = $data->invoiceNr;
            if (isset($data->amountPaid)) $this->amountPaid = $data->amountPaid;
            if (isset($data->status)) $this->status = $data->status;
            if (isset($data->total)) $this->total = $data->total;
            if (isset($data->date_created)) $this->dateCreated = new \DateTime($data->date_created);
            if (isset($data->date_reminder)) $this->dateReminder = new \DateTime($data->date_reminder);
            if (isset($data->date_payed)) $this->datePayed = new \DateTime($data->date_payed);
        }
    }
}