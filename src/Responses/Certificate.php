<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class Certificate extends Base
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $domainName;

    /** @var string[] */
    public array $subjectAlternativeNames;

    /** @var DateTime */
    public DateTime $dateIssued;

    /** @var DateTime */
    public DateTime $dateExpired;

    /** @var string */
    public string $company;

    /** @var int */
    public int $customerId;

    /** @var Product */
    public Product $product;

    /** @var bool */
    public bool $valid;

    /**
     * Certificate constructor.
     * @param $data
     * @throws Exception
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            if (isset($data->id)) {
                $this->id = (int) $data->id;
            }
            if (isset($data->domainName)) {
                $this->domainName = $data->domainName;
            }
            if (isset($data->subjectAlternativeNames)) {
                $this->subjectAlternativeNames = $data->subjectAlternativeNames;
            }
            if (isset($data->dateIssued)) {
                $this->dateIssued = new DateTime($data->dateIssued);
            }
            if (isset($data->dateExpired)) {
                $this->dateExpired = new DateTime($data->dateExpired);
            }
            if (isset($data->company)) {
                $this->company = $data->company;
            }
            if (isset($data->customerId)) {
                $this->customerId = (int) $data->customerId;
            }
            if (isset($data->valid)) {
                $this->valid = (bool) $data->valid;
            }

            if (isset($data->_embedded->product)) {
                $this->product = new Product($data->_embedded->product);
            };
        }
    }

    public function isExpired(): bool
    {
        return (new DateTime()) >= $this->dateExpired;
    }
}
