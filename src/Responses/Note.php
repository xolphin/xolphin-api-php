<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class Note extends Base
{
    /** @var int|null */
    public ?int $id = null;

    /** @var string|null */
    public ?string $contact = null;

    /** @var string|null */
    public ?string $staff = null;

    /** @var string|null */
    public ?string $date = null;

    /** @var string|null */
    public ?string $time = null;

    /** @var string|null */
    public ?string $messageBody = null;

    /** @var DateTime|null */
    public ?DateTime $createdAt = null;

    /** @var bool|null */
    public ?bool $endCustomer = null;

    /**
     * Note constructor.
     * @param object $data
     * @throws Exception
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (isset($data->id)) {
            $this->id = (int) $data->id;
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
