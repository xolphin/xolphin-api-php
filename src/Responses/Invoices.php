<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use Exception;

class Invoices extends Base
{
    /** @var Invoice[] */
    public array $invoices = [];

    /**
     * Requests constructor.
     * @param object $data
     * @throws Exception
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            foreach ($this->_embedded->invoices as $invoice) {
                $this->invoices[] = new Invoice($invoice);
            }
        }
    }
}
