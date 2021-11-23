<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;

class RequestEE extends Base
{
    /** @var int */
    public int $id;

    /** @var DateTime */
    public DateTime $dateOrdered;

    /** @var string */
    public string $crt;

    /** @var string */
    public string $pkcs7;

    /**
     * RequestEE constructor.
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (isset($data->id)) {
            $this->id = $data->id;
        }
        if (isset($data->dateOrdered)) {
            $this->dateOrdered = $data->dateOrdered;
        }
        if (isset($data->crt)) {
            $this->crt = $data->crt;
        }
        if (isset($data->pkcs7)) {
            $this->pkcs7 = $data->pkcs7;
        }
    }
}
