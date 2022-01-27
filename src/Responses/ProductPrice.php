<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class ProductPrice
{
    /** @var int|null */
    public ?int $years = null;

    /** @var float|null */
    public ?float $price = null;

    /** @var float|null */
    public ?float $priceExtra = null;

    /** @var float|null */
    public ?float $priceExtraWildcard = null;

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
