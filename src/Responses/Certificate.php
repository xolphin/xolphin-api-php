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
            if(!empty($data->id)) $this->id = $data->id;
            if(!empty($data->domainName)) $this->domainName = $data->domainName;
            if(!empty($data->subjectAlternativeNames)) $this->subjectAlternativeNames = $data->subjectAlternativeNames;
            if(!empty($data->dateIssued)) $this->dateIssued = new \DateTime($data->dateIssued);
            if(!empty($data->dateExpired)) $this->dateExpired = new \DateTime($data->dateExpired);
            if(!empty($data->company)) $this->company = $data->company;
            if(!empty($data->customerId)) $this->customerId = $data->customerId;

            if(!empty($data->_embedded->product)) {
                $this->product = new Product($data->_embedded->product);
            };
        }
    }

    public function isExpired() {
        return (new \DateTime()) >= $this->dateExpired;
    }
}