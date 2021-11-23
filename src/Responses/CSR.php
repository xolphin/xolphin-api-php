<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class CSR extends Base
{
    /** @var string */
    public string $type;

    /** @var int */
    public int $size;

    /** @var string */
    public string $company;

    /** @var string */
    public string $cn;

    /** @var string */
    public string $state;

    /** @var string */
    public string $city;

    /** @var string */
    public string $country;

    /** @var string[] */
    public array $altNames = [];

    /**
     * CSR constructor.
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            if (isset($data->type)) {
                $this->type = $data->type;
            }
            if (isset($data->size)) {
                $this->size = $data->size;
            }
            if (isset($data->company)) {
                $this->company = $data->company;
            }
            if (isset($data->cn)) {
                $this->cn = $data->cn;
            }
            if (isset($data->state)) {
                $this->state = $data->state;
            }
            if (isset($data->city)) {
                $this->city = $data->city;
            }
            if (isset($data->country)) {
                $this->country = $data->country;
            }
            if (isset($data->altNames)) {
                $this->altNames = $data->altNames;
            }
        }
    }
}
