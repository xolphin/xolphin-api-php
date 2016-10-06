<?php

namespace Xolphin\Responses;

class CSR extends Base {
    /** @var string */
    public $type;
    /** @var int */
    public $size;
    /** @var string */
    public $company;
    /** @var string */
    public $cn;
    /** @var string */
    public $state;
    /** @var string */
    public $city;
    /** @var string */
    public $country;
    /** @var string[] */
    public $altNames = [];

    public function __construct($data) {
        parent::__construct($data);

        if(!$this->isError()) {
            if(isset($data->type)) $this->type = $data->type;
            if(isset($data->size)) $this->size = $data->size;
            if(isset($data->company)) $this->company = $data->company;
            if(isset($data->cn)) $this->cn = $data->cn;
            if(isset($data->state)) $this->state = $data->state;
            if(isset($data->city)) $this->city = $data->city;
            if(isset($data->country)) $this->country = $data->country;
            if(isset($data->altNames)) $this->altNames = $data->altNames;
        }
    }
}