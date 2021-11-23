<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class ValidationCall extends Base
{
    /** @var int */
    public int $requestId;

    /** @var DateTime */
    public DateTime $date;

    /** @var DateTime|string */
    public $time;

    /**
     * ValidationCall constructor.
     * @param $data
     * @throws Exception
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (isset($data->requestId)) {
            $this->requestId = $data->requestId;
        }
        if (isset($data->date)) {
            $this->date = (new DateTime($data->date));
        }
        if (isset($data->time)) {
            $this->time = (new DateTime($data->time))->format('H:i:s');
        }
    }
}
