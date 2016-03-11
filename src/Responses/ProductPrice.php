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
        if(!empty($data->years)) $this->years = (int)$data->years;
        if(!empty($data->price)) $this->price = (float)$data->price;
        if(!empty($data->priceExtra)) $this->priceExtra = (float)$data->priceExtra;
        if(!empty($data->priceExtraWildcard)) $this->priceExtraWildcard = (float)$data->priceExtraWildcard;
    }
}