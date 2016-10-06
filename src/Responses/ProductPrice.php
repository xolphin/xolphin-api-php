<?php

namespace Xolphin\Responses;

class ProductPrice {
    /** @var int */
    public $years;
    /** @var float */
    public $price;
    /** @var float */
    public $priceExtra;
    /** @var float */
    public $priceExtraWildcard;

    public function __construct($data) {
        if(isset($data->years)) $this->years = (int)$data->years;
        if(isset($data->price)) $this->price = (float)$data->price;
        if(isset($data->priceExtra)) $this->priceExtra = (float)$data->priceExtra;
        if(isset($data->priceExtraWildcard)) $this->priceExtraWildcard = (float)$data->priceExtraWildcard;
    }
}