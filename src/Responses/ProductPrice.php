<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class ProductPrice
{
    /** @var int */
    public int $years;

    /** @var float */
    public float $price;

    /** @var float */
    public float $priceExtra;

    /** @var float */
    public float $priceExtraWildcard;

    /**
     * ProductPrice constructor.
     * @param $data
     */
    public function __construct($data)
    {
        if (isset($data->years)) {
            $this->years = (int) $data->years;
        }
        if (isset($data->price)) {
            $this->price = (float) $data->price;
        }
        if (isset($data->extraPrice)) {
            $this->priceExtra = (float) $data->extraPrice;
        }
        if (isset($data->extraPriceWildcard)) {
            $this->priceExtraWildcard = (float) $data->extraPriceWildcard;
        }
    }
}
