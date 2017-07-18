<?php

namespace Xolphin\Responses;

class RequestEE extends Base{

    /** @var int */
    public $id;

    /** @var \DateTime */
    public $dateOrdered;

    /** @var  string */
    public $crt;

    /** @var string */
    public $pkcs7;

    public function __construct($data)
    {
        parent::__construct($data);

        if(isset($data->id))            $this->id           = $data->id;
        if(isset($data->dateOrdered))   $this->dateOrdered  = $data->dateOrdered;
        if(isset($data->crt))           $this->crt          = $data->crt;
        if(isset($data->pkcs7))         $this->pkcs7        = $data->pkcs7;
    }

}