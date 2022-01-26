<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class Invoice extends Base
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $currency;

    /** @var float */
    public float $amount;

    /** @var float */
    public float $tax;

    /** @var int */
    public int $invoiceNr;

    /** @var float */
    public float $amountPaid;

    /** @var string */
    public string $status;

    /** @var float */
    public float $total;

    /** @var DateTime */
    public DateTime $dateCreated;

    /** @var DateTime */
    public DateTime $dateReminder;

    /** @var DateTime */
    public DateTime $datePayed;

    /**
     * Request constructor.
     * @param object $data
     * @throws Exception
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            if (isset($data->id)) {
                $this->id = (int) $data->id;
            }
            if (isset($data->currency)) {
                $this->currency = $data->currency;
            }
            if (isset($data->amount)) {
                $this->amount = (float) $data->amount;
            }
            if (isset($data->tax)) {
                $this->tax = (float) $data->tax;
            }
            if (isset($data->invoiceNr)) {
                $this->invoiceNr = (int) $data->invoiceNr;
            }
            if (isset($data->amountPaid)) {
                $this->amountPaid = (float) $data->amountPaid;
            }
            if (isset($data->status)) {
                $this->status = $data->status;
            }
            if (isset($data->total)) {
                $this->total = (float) $data->total;
            }
            if (isset($data->date_created)) {
                $this->dateCreated = new DateTime($data->date_created);
            }
            if (isset($data->date_reminder)) {
                $this->dateReminder = new DateTime($data->date_reminder);
            }
            if (isset($data->date_payed)) {
                $this->datePayed = new DateTime($data->date_payed);
            }
        }
    }
}
