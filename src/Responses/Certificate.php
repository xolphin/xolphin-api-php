<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class Certificate extends Base
{
    /** @var int|null */
    public ?int $id = null;

    /** @var string|null */
    public ?string $domainName = null;

    /** @var string[]|null */
    public ?array $subjectAlternativeNames = null;

    /** @var DateTime|null */
    public ?DateTime $dateIssued = null;

    /** @var DateTime|null */
    public ?DateTime $dateExpired = null;

    /** @var DateTime|null */
    public ?DateTime $dateSubscriptionExpired = null;

    /** @var string|null */
    public ?string $company = null;

    /** @var int|null */
    public ?int $customerId = null;

    /** @var Product|null */
    public ?Product $product = null;

    /** @var bool|null */
    public ?bool $valid = null;

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
            if (isset($data->dateSubscriptionExpired)) {
                $this->dateSubscriptionExpired = new DateTime($data->dateSubscriptionExpired);
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
