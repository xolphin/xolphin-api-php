<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class ValidationCall extends Base
{
    /** @var int|null */
    public ?int $requestId = null;

    /** @var DateTime|null */
    public ?DateTime $date = null;

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
            $this->requestId = (int) $data->requestId;
        }
        if (isset($data->date)) {
            $this->date = (new DateTime($data->date));
        }
        if (isset($data->time)) {
            $this->time = (new DateTime($data->time))->format('H:i:s');
        }
    }
}
