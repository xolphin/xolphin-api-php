<?php

namespace Xolphin\Responses;

use DateTime;
use Exception;

class Request extends Base
{
    /** @var int */
    public $id;

    /** @var string */
    public $domainName;

    /** @var string[] */
    public $subjectAlternativeNames;

    /** @var int */
    public $years;

    /** @var string */
    public $company;

    /** @var DateTime */
    public $dateOrdered;

    /** @var RequestValidation[] */
    public $validations;

    /** @var string */
    public $department;

    /** @var string */
    public $address;

    /** @var string */
    public $zipcode;

    /** @var string */
    public $city;

    /** @var string */
    public $province;

    /** @var string */
    public $country;

    /** @var string */
    public $reference;

    /** @var string */
    public $approverFirstName;

    /** @var string */
    public $approverLastName;

    /** @var string */
    public $approverEmail;

    /** @var string */
    public $approverPhone;

    /** @var string */
    public $kvk;

    /** @var Product */
    public $product;

    /** @var bool */
    public $requiresAction = false;

    /** @var bool */
    public $brandValidation = false;

    /** @var Note[] */
    public $notes = [];

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
                $this->id = $data->id;
            }
            if (isset($data->domainName)) {
                $this->domainName = $data->domainName;
            }
            if (isset($data->subjectAlternativeNames)) {
                $this->subjectAlternativeNames = $data->subjectAlternativeNames;
            }
            if (isset($data->years)) {
                $this->years = $data->years;
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
                $this->requiresAction = $data->requiresAction;
            }
            if (isset($data->brandValidation)) {
                $this->brandValidation = $data->brandValidation;
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
