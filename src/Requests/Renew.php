<?php

namespace Xolphin\Requests;

use Xolphin\Responses\Product;

class Renew {
    /** @var Product */
    private $product;

    /** @var int */
    private $years;

    /** @var string */
    private $csr;

    /** @var string */
    private $dcvType;

    /** @var string[] */
    private $subjectAlternativeNames = [];

    /** @var RequestDCV[] */
    private $dcv = [];

    /** @var string */
    private $company;

    /** @var string */
    private $department;

    /** @var string */
    private $address;

    /** @var string */
    private $zipcode;

    /** @var string */
    private $city;

    /** @var string */
    private $approverFirstName;

    /** @var string */
    private $approverLastName;

    /** @var string */
    private $approverEmail;

    /** @var string */
    private $approverPhone;

    /** @var string */
    private $kvk;

    /** @var string */
    private $reference;

    /** @var string */
    private $uniqueValueDcv = null;

    /**
     * Renew constructor.
     * @param Product $product
     * @param int $years
     * @param string $csr
     * @param string $dcvType
     */
    public function __construct($product, $years, $csr, $dcvType) {
        $this->product = $product;
        $this->years = $years;
        $this->csr = $csr;
        $this->dcvType = $dcvType;
    }

    public function getArray() {
        $result = [];
        $result['product'] = $this->product->id;
        $result['years'] = $this->years;
        $result['csr'] = $this->csr;
        $result['dcvType'] = $this->dcvType;
        if(!empty($this->subjectAlternativeNames)) $result['subjectAlternativeNames'] = implode(',', $this->subjectAlternativeNames);
        if(!empty($this->dcv)) $result['dcv'] = json_encode($this->dcv);
        if(!empty($this->company)) $result['company'] = $this->company;
        if(!empty($this->department)) $result['department'] = $this->department;
        if(!empty($this->address)) $result['address'] = $this->address;
        if(!empty($this->zipcode)) $result['zipcode'] = $this->zipcode;
        if(!empty($this->city)) $result['city'] = $this->city;
        if(!empty($this->approverFirstName)) $result['approverFirstName'] = $this->approverFirstName;
        if(!empty($this->approverLastName)) $result['approverLastName'] = $this->approverLastName;
        if(!empty($this->approverEmail)) $result['approverEmail'] = $this->approverEmail;
        if(!empty($this->approverPhone)) $result['approverPhone'] = $this->approverPhone;
        if(!empty($this->kvk)) $result['kvk'] = $this->kvk;
        if(!empty($this->reference)) $result['reference'] = $this->reference;
        if(!is_null($this->uniqueValueDcv)) $result['uniqueValueDcv'] = $this->uniqueValueDcv;
        return $result;
    }

    /**
     * @return string[]
     */
    public function getSubjectAlternativeNames()
    {
        return $this->subjectAlternativeNames;
    }

    /**
     * @param string $subjectAlternativeNames
     * @return Renew
     */
    public function addSubjectAlternativeNames($subjectAlternativeNames)
    {
        $this->subjectAlternativeNames[] = $subjectAlternativeNames;
        return $this;
    }

    /**
     * @return RequestDCV[]
     */
    public function getDcv()
    {
        return $this->dcv;
    }

    /**
     * @param RequestDCV $dcv
     * @return Renew
     */
    public function addDcv($dcv)
    {
        $this->dcv[] = $dcv;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return Renew
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param string $department
     * @return Renew
     */
    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Renew
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return Renew
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Renew
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverFirstName()
    {
        return $this->approverFirstName;
    }

    /**
     * @param string $approverFirstName
     * @return Renew
     */
    public function setApproverFirstName($approverFirstName)
    {
        $this->approverFirstName = $approverFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverLastName()
    {
        return $this->approverLastName;
    }

    /**
     * @param string $approverLastName
     * @return Renew
     */
    public function setApproverLastName($approverLastName)
    {
        $this->approverLastName = $approverLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverEmail()
    {
        return $this->approverEmail;
    }

    /**
     * @param string $approverEmail
     * @return Renew
     */
    public function setApproverEmail($approverEmail)
    {
        $this->approverEmail = $approverEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverPhone()
    {
        return $this->approverPhone;
    }

    /**
     * @param string $approverPhone
     * @return Renew
     */
    public function setApproverPhone($approverPhone)
    {
        $this->approverPhone = $approverPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getKvk()
    {
        return $this->kvk;
    }

    /**
     * @param string $kvk
     * @return Renew
     */
    public function setKvk($kvk)
    {
        $this->kvk = $kvk;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Renew
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueValueDcv()
    {
        return $this->uniqueValueDcv;
    }

    /**
     * @param $uniqueValue
     * @return Renew
     */
    public function setUniqueValueDcv($uniqueValue)
    {
        $this->uniqueValueDcv = $uniqueValue;
        return $this;
    }
}
