<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class Product extends Base
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $brand;

    /** @var string */
    public string $name;

    /** @var string */
    public string $type;

    /** @var string */
    public string $validation;

    /** @var int */
    public int $includeDomains;

    /** @var int */
    public int $maxDomains;

    /** @var ProductPrice[] */
    public array $prices = [];

    /**
     * Product constructor.
     * @param object $data
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            if (isset($data->id)) {
                $this->id = (int) $data->id;
            }
            if (isset($data->brand)) {
                $this->brand = $data->brand;
            }
            if (isset($data->name)) {
                $this->name = $data->name;
            }
            if (isset($data->type)) {
                $this->type = $data->type;
            }
            if (isset($data->validation)) {
                $this->validation = $data->validation;
            }
            if (isset($data->includedDomains)) {
                $this->includeDomains = (int) $data->includedDomains;
            }
            if (isset($data->maxDomains)) {
                $this->maxDomains = (int) $data->maxDomains;
            }

            if (!empty($data->prices)) {
                foreach ($data->prices as $price) {
                    $this->prices[] = new ProductPrice($price);
                }
            }
        }
    }
}
