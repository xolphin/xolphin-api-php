<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use DateTime;
use Exception;

class Request extends Base
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $domainName;

    /** @var string[] */
    public array $subjectAlternativeNames;

    /** @var int */
    public int $years;

    /** @var string */
    public string $company;

    /** @var DateTime */
    public DateTime $dateOrdered;

    /** @var RequestValidation[] */
    public array $validations;

    /** @var string */
    public string $department;

    /** @var string */
    public string $address;

    /** @var string */
    public string $zipcode;

    /** @var string */
    public string $city;

    /** @var string */
    public string $province;

    /** @var string */
    public string $country;

    /** @var string */
    public string $reference;

    /** @var string */
    public string $approverFirstName;

    /** @var string */
    public string $approverLastName;

    /** @var string */
    public string $approverEmail;

    /** @var string */
    public string $approverPhone;

    /** @var string|null */
    public ?string $kvk = null;

    /** @var Product */
    public Product $product;

    /** @var bool */
    public bool $requiresAction = false;

    /** @var bool */
    public bool $brandValidation = false;

    /** @var Note[] */
    public array $notes = [];

    /**
     * Request constructor.
     * @param object $data
     * @throws Exception
     */
    function __construct($data)
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
            if (isset($data->years)) {
                $this->years = (int) $data->years;
            }
            if (isset($data->company)) {
                $this->company = $data->company;
            }
            if (isset($data->dateOrdered)) {
                $this->dateOrdered = new DateTime($data->dateOrdered);
            }
            if (isset($data->department)) {
                $this->department = $data->department;
            }
            if (isset($data->address)) {
                $this->address = $data->address;
            }
            if (isset($data->zipcode)) {
                $this->zipcode = $data->zipcode;
            }
            if (isset($data->city)) {
                $this->city = $data->city;
            }
            if (isset($data->province)) {
                $this->province = $data->province;
            }
            if (isset($data->country)) {
                $this->country = $data->country;
            }
            if (isset($data->reference)) {
                $this->reference = $data->reference;
            }
            if (isset($data->approverFirstName)) {
                $this->approverFirstName = $data->approverFirstName;
            }
            if (isset($data->approverLastName)) {
                $this->approverLastName = $data->approverLastName;
            }
            if (isset($data->approverEmail)) {
                $this->approverEmail = $data->approverEmail;
            }
            if (isset($data->approverPhone)) {
                $this->approverPhone = $data->approverPhone;
            }
            if (isset($data->kvk)) {
                $this->kvk = $data->kvk;
            }
            if (isset($data->requiresAction)) {
                $this->requiresAction = (bool) $data->requiresAction;
            }
            if (isset($data->brandValidation)) {
                $this->brandValidation = (bool) $data->brandValidation;
            }

            if (!empty($data->validations)) {
                foreach (get_object_vars($data->validations) as $k => $v) {
                    $this->validations[$k] = new RequestValidation($data->validations->$k);
                }
            }

            if (isset($data->_embedded->product)) {
                $this->product = new Product($data->_embedded->product);
            }

            if (isset($data->_embedded->notes) && is_array($data->_embedded->notes)) {
                foreach ($data->_embedded->notes as $note) {
                    $this->notes[] = new Note($note);
                }
            }
        }
    }
}
