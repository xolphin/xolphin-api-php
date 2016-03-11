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
            if(!empty($data->id)) $this->id = $data->id;
            if(!empty($data->brand)) $this->brand = $data->brand;
            if(!empty($data->name)) $this->name = $data->name;
            if(!empty($data->type)) $this->type = $data->type;
            if(!empty($data->validation)) $this->validation = $data->validation;
            if(!empty($data->includeDomains)) $this->includeDomains = $data->includeDomains;
            if(!empty($data->maxDomains)) $this->maxDomains = $data->maxDomains;

            if(!empty($data->prices)) {
                foreach($data->prices as $price) {
                    $this->prices[] = new ProductPrice($price);
                }
            }
        }
    }
}