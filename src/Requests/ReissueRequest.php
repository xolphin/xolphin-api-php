<?php

namespace Xolphin\Requests;


class ReissueRequest
{
    /** @var string */
    private $csr;

    /** @var string $dcvType use one of the following: EMAIL_VALIDATION, FILE_VALIDATION, DNS_VALIDATION */
    private $dcvType;

    /** @var string[] */
    private $subjectAlternativeNames;

    /** @var DCVDomain[] */
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
     * Reissue constructor.
     * @param string $csr
     * @param string $dcvType use one of the following: EMAIL_VALIDATION, FILE_VALIDATION, DNS_VALIDATION
     */
    public function __construct(string $csr, string $dcvType)
    {
        $this->csr = $csr;
        $this->dcvType = $dcvType;
    }

    /**
     * @return array
     */
    public function getApiRequestBody(): array
    {
        $result = [];
        $result['csr'] = $this->csr;
        $result['dcvType'] = $this->dcvType;
        if (!empty($this->subjectAlternativeNames)) {
            $result['subjectAlternativeNames'] = implode(',', $this->subjectAlternativeNames);
        }
        if (!empty($this->dcv)) {
            $result['dcv'] = json_encode($this->dcv);
        }
        if (!empty($this->company)) {
            $result['company'] = $this->company;
        }
        if (!empty($this->department)) {
            $result['department'] = $this->department;
        }
        if (!empty($this->address)) {
            $result['address'] = $this->address;
        }
        if (!empty($this->zipcode)) {
            $result['zipcode'] = $this->zipcode;
        }
        if (!empty($this->city)) {
            $result['city'] = $this->city;
        }
        if (!empty($this->approverFirstName)) {
            $result['approverFirstName'] = $this->approverFirstName;
        }
        if (!empty($this->approverLastName)) {
            $result['approverLastName'] = $this->approverLastName;
        }
        if (!empty($this->approverEmail)) {
            $result['approverEmail'] = $this->approverEmail;
        }
        if (!empty($this->approverPhone)) {
            $result['approverPhone'] = $this->approverPhone;
        }
        if (!empty($this->kvk)) {
            $result['kvk'] = $this->kvk;
        }
        if (!empty($this->reference)) {
            $result['reference'] = $this->reference;
        }
        if (!is_null($this->uniqueValueDcv)) {
            $result['uniqueValueDcv'] = $this->uniqueValueDcv;
        }
        return $result;
    }

    /**
     * @return string[]
     */
    public function getSubjectAlternativeNames(): array
    {
        return $this->subjectAlternativeNames;
    }

    /**
     * @param string $subjectAlternativeNames
     * @return ReissueRequest
     */
    public function addSubjectAlternativeNames($subjectAlternativeNames): ReissueRequest
    {
        $this->subjectAlternativeNames[] = $subjectAlternativeNames;
        return $this;
    }

    /**
     * @return DCVDomain[]
     */
    public function getDcv(): array
    {
        return $this->dcv;
    }

    /**
     * @param DCVDomain $dcv
     * @return ReissueRequest
     */
    public function addDcv(DCVDomain $dcv): ReissueRequest
    {
        $this->dcv[] = $dcv;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return ReissueRequest
     */
    public function setCompany(string $company): ReissueRequest
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @param string $department
     * @return ReissueRequest
     */
    public function setDepartment(string $department): ReissueRequest
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return ReissueRequest
     */
    public function setAddress(string $address): ReissueRequest
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return ReissueRequest
     */
    public function setZipcode(string $zipcode): ReissueRequest
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return ReissueRequest
     */
    public function setCity(string $city): ReissueRequest
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverFirstName(): string
    {
        return $this->approverFirstName;
    }

    /**
     * @param string $approverFirstName
     * @return ReissueRequest
     */
    public function setApproverFirstName(string $approverFirstName): ReissueRequest
    {
        $this->approverFirstName = $approverFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverLastName(): string
    {
        return $this->approverLastName;
    }

    /**
     * @param string $approverLastName
     * @return ReissueRequest
     */
    public function setApproverLastName(string $approverLastName): ReissueRequest
    {
        $this->approverLastName = $approverLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverEmail(): string
    {
        return $this->approverEmail;
    }

    /**
     * @param string $approverEmail
     * @return ReissueRequest
     */
    public function setApproverEmail(string $approverEmail): ReissueRequest
    {
        $this->approverEmail = $approverEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverPhone(): string
    {
        return $this->approverPhone;
    }

    /**
     * @param string $approverPhone
     * @return ReissueRequest
     */
    public function setApproverPhone(string $approverPhone): ReissueRequest
    {
        $this->approverPhone = $approverPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getKvk(): string
    {
        return $this->kvk;
    }

    /**
     * @param string $kvk
     * @return ReissueRequest
     */
    public function setKvk(string $kvk): ReissueRequest
    {
        $this->kvk = $kvk;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return ReissueRequest
     */
    public function setReference(string $reference): ReissueRequest
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueValueDcv(): string
    {
        return $this->uniqueValueDcv;
    }

    /**
     * @param $uniqueValue
     * @return ReissueRequest
     */
    public function setUniqueValueDcv(string $uniqueValue): ReissueRequest
    {
        $this->uniqueValueDcv = $uniqueValue;
        return $this;
    }
}
