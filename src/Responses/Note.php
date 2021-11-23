<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class Note extends Base
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $contact;

    /** @var string */
    public string $staff;

    /** @var string */
    public string $date;

    /** @var string */
    public string $time;

    /** @var string */
    public string $messageBody;

    /** @var DateTime */
    public DateTime $createdAt;

    /** @var bool */
    public bool $endCustomer;

    /**
     * Note constructor.
     * @param object $data
     * @throws Exception
     */
    function __construct($data)
    {
        parent::__construct($data);

        if (isset($data->id)) {
            $this->id = $data->id;
        }
        if (isset($data->contact)) {
            $this->contact = $data->contact;
        }
        if (isset($data->staff)) {
            $this->staff = $data->staff;
        }
        if (isset($data->date)) {
            $this->date = $data->date;
        }
        if (isset($data->time)) {
            $this->time = $data->time;
        }
        if (isset($data->message)) {
            $this->messageBody = $data->message;
        }
        if (isset($data->createdAt)) {
            $this->createdAt = new DateTime($data->createdAt);
        }
        if (isset($data->endCustomer)) {
            $this->endCustomer = $data->endCustomer;
        }
    }
}
