<?php

namespace Xolphin\Responses;

class Certificate extends Base {
    /** @var int */
    public $id;

    /** @var string */
    public $domainName;

    /** @var string[] */
    public $subjectAlternativeNames;

    /** @var \DateTime */
    public $dateIssued;

    /** @var \DateTime */
    public $dateExpired;

    /** @var string */
    public $company;

    /** @var int */
    public $customerId;

    /** @var Product */
    public $product;

    /**
     * Request constructor.
     * @param object $data
     */
    function __construct($data) {
        parent::__construct($data);

        if(!$this->isError()) {
            if(isset($data->id)) $this->id = $data->id;
            if(isset($data->domainName)) $this->domainName = $data->domainName;
            if(isset($data->subjectAlternativeNames)) $this->subjectAlternativeNames = $data->subjectAlternativeNames;
            if(isset($data->dateIssued)) $this->dateIssued = new \DateTime($data->dateIssued);
            if(isset($data->dateExpired)) $this->dateExpired = new \DateTime($data->dateExpired);
            if(isset($data->company)) $this->company = $data->company;
            if(isset($data->customerId)) $this->customerId = $data->customerId;

            if(isset($data->_embedded->product)) {
                $this->product = new Product($data->_embedded->product);
            };
        }
    }

    public function isExpired() {
        return (new \DateTime()) >= $this->dateExpired;
    }
}