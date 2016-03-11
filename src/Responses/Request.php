<?php

namespace Xolphin\Responses;

class Request extends Base {
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

    /** @var \DateTime */
    public $dateOrdered;

    /** @var RequestValidation[]  */
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

    /**
     * Request constructor.
     * @param object $data
     */
    function __construct($data) {
        parent::__construct($data);

        if(!$this->isError()) {
            if(!empty($data->id)) $this->id = $data->id;
            if(!empty($data->domainName)) $this->domainName = $data->domainName;
            if(!empty($data->subjectAlternativeNames)) $this->subjectAlternativeNames = $data->subjectAlternativeNames;
            if(!empty($data->years)) $this->years = $data->years;
            if(!empty($data->company)) $this->company = $data->company;
            if(!empty($data->dateOrdered)) $this->dateOrdered = new \DateTime($data->dateOrdered);
            if(!empty($data->department)) $this->department = $data->department;
            if(!empty($data->address)) $this->address = $data->address;
            if(!empty($data->zipcode)) $this->zipcode = $data->zipcode;
            if(!empty($data->city)) $this->city = $data->city;
            if(!empty($data->province)) $this->province = $data->province;
            if(!empty($data->country)) $this->country = $data->country;
            if(!empty($data->reference)) $this->reference = $data->reference;
            if(!empty($data->approverFirstName)) $this->approverFirstName = $data->approverFirstName;
            if(!empty($data->approverLastName)) $this->approverLastName = $data->approverLastName;
            if(!empty($data->approverEmail)) $this->approverEmail = $data->approverEmail;
            if(!empty($data->approverPhone)) $this->approverPhone = $data->approverPhone;
            if(!empty($data->kvk)) $this->kvk = $data->kvk;

            if(!empty($data->validations)) {
                foreach(get_object_vars($data->validations) as $k => $v) {
                    $this->validations[$k] = new RequestValidation($data->validations->$k);
                }
            }

            if(!empty($data->_embedded->product)) {
                $this->product = new Product($data->_embedded->product);
            };
        }
    }
}