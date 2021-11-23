<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class Products extends Base
{
    /** @var Product[] */
    public array $products = [];

    /**
     * ProductsResponse constructor.
     * @param object $data
     */
    function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            foreach ($this->_embedded->products as $product) {
                $this->products[] = new Product($product);
            }
        }
    }
}
