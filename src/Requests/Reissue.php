<?php

namespace Xolphin\Requests;

use Xolphin\Responses\Product;

class Reissue {
    /** @var string */
    private $csr;

    /** @var string */
    private $dcvType;

    /** @var string[] */
    private $subjectAlternativeNames;

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

    /**
     * Reissue constructor.
     * @param string $csr
     * @param string $dcvType
     */
    public function __construct($csr, $dcvType) {
        $this->csr = $csr;
        $this->dcvType = $dcvType;
    }

    public function getArray() {
        $result = [];
        $result['csr'] = $this->csr;
        $result['dcvType'] = $this->dcvType;
        $result['subjectAlternativeNames'] = implode(',', $this->subjectAlternativeNames);
        $result['dcv'] = json_encode($this->dcv);
        $result['company'] = $this->company;
        $result['department'] = $this->department;
        $result['address'] = $this->address;
        $result['zipcode'] = $this->zipcode;
        $result['city'] = $this->city;
        $result['approverFirstName'] = $this->approverFirstName;
        $result['approverLastName'] = $this->approverLastName;
        $result['approverEmail'] = $this->approverEmail;
        $result['approverPhone'] = $this->approverPhone;
        $result['kvk'] = $this->kvk;
        $result['reference'] = $this->reference;
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }
}