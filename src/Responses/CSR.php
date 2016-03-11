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
            if(!empty($data->type)) $this->type = $data->type;
            if(!empty($data->size)) $this->size = $data->size;
            if(!empty($data->company)) $this->company = $data->company;
            if(!empty($data->cn)) $this->cn = $data->cn;
            if(!empty($data->state)) $this->state = $data->state;
            if(!empty($data->city)) $this->city = $data->city;
            if(!empty($data->country)) $this->country = $data->country;
            if(!empty($data->altNames)) $this->altNames = $data->altNames;
        }
    }
}