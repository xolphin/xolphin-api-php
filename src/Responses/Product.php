<?php

namespace Xolphin\Responses;

class Product extends Base {
    /** @var int */
    public $id;
    /** @var string */
    public $brand;
    /** @var string */
    public $name;
    /** @var string */
    public $type;
    /** @var string */
    public $validation;
    /** @var int */
    public $includeDomains;
    /** @var int */
    public $maxDomains;
    /** @var ProductPrice[] */
    public $prices = [];

    /**
     * Product constructor.
     * @param object $data
     */
    public function __construct($data) {
        parent::__construct($data);

        if(!$this->isError()) {
            if(isset($data->id)) $this->id = $data->id;
            if(isset($data->brand)) $this->brand = $data->brand;
            if(isset($data->name)) $this->name = $data->name;
            if(isset($data->type)) $this->type = $data->type;
            if(isset($data->validation)) $this->validation = $data->validation;
            if(isset($data->includedDomains)) $this->includeDomains = $data->includedDomains;
            if(isset($data->maxDomains)) $this->maxDomains = $data->maxDomains;

            if(!empty($data->prices)) {
                foreach($data->prices as $price) {
                    $this->prices[] = new ProductPrice($price);
                }
            }
        }
    }
}
