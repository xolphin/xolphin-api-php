<?php

declare(strict_types=1);

namespace Xolphin\Requests;

use Xolphin\Requests\Contracts\ApiRequestInterface;

class RenewRequest implements ApiRequestInterface
{
    /** @var int */
    private int $productId;

    /** @var int */
    private int $years;

    /** @var string */
    private string $csr;

    /** @var string $dcvType use one of the following: EMAIL_VALIDATION, FILE_VALIDATION, DNS_VALIDATION */
    private string $dcvType;

    /** @var string[] */
    private array $subjectAlternativeNames = [];

    /** @var DCVDomain[] */
    private array $dcv = [];

    /** @var string */
    private string $company;

    /** @var string */
    private string $department;

    /** @var string */
    private string $address;

    /** @var string */
    private string $zipcode;

    /** @var string */
    private string $city;

    /** @var string */
    private string $province;

    /** @var string */
    private string $country;

    /** @var string */
    private string $approverFirstName;

    /** @var string */
    private string $approverLastName;

    /** @var string */
    private string $approverEmail;

    /** @var string */
    private string $approverPhone;

    /** @var string */
    private string $approverRepresentativePosition;

    /** @var string */
    private string $approverRepresentativeFirstName;

    /** @var string */
    private string $approverRepresentativeLastName;

    /** @var string */
    private string $approverRepresentativeEmail;

    /** @var string */
    private string $approverRepresentativePhone;

    /** @var string */
    private string $kvk;

    /** @var string */
    private string $reference;

    /** @var string|null */
    private ?string $uniqueValueDcv = null;

    /** @var bool */
    private bool $disableFreeSan = false;

    /**
     * Renew constructor.
     * @param int $productId
     * @param int $years
     * @param string $csr
     * @param string $dcvType use one of the following: EMAIL_VALIDATION, FILE_VALIDATION, DNS_VALIDATION
     */
    public function __construct(int $productId, int $years, string $csr, string $dcvType)
    {
        $this->productId = $productId;
        $this->years = $years;
        $this->csr = $csr;
        $this->dcvType = $dcvType;
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
     * @return RenewRequest
     */
    public function addSubjectAlternativeNames(string $subjectAlternativeNames): RenewRequest
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
     * @return RenewRequest
     */
    public function addDcv(DCVDomain $dcv): RenewRequest
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
     * @return RenewRequest
     */
    public function setCompany(string $company): RenewRequest
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
     * @return RenewRequest
     */
    public function setDepartment(string $department): RenewRequest
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
     * @return RenewRequest
     */
    public function setAddress(string $address): RenewRequest
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
     * @return RenewRequest
     */
    public function setZipcode(string $zipcode): RenewRequest
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
     * @return RenewRequest
     */
    public function setCity(string $city): RenewRequest
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @param string $province
     * @return RenewRequest
     */
    public function setProvince(string $province): RenewRequest
    {
        $this->province = $province;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return RenewRequest
     */
    public function setCountry(string $country): RenewRequest
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverFirstName(): string
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated use getApproverRepresentativeFirstName', E_USER_DEPRECATED);
        return $this->approverFirstName;
    }

    /**
     * @param string $approverFirstName
     * @return RenewRequest
     */
    public function setApproverFirstName(string $approverFirstName): RenewRequest
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated use setApproverRepresentativeFirstName', E_USER_DEPRECATED);
        $this->approverFirstName = $approverFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverLastName(): string
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated use getApproverRepresentativeLastName', E_USER_DEPRECATED);
        return $this->approverLastName;
    }

    /**
     * @param string $approverLastName
     * @return RenewRequest
     */
    public function setApproverLastName(string $approverLastName): RenewRequest
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated use setApproverRepresentativeLastName', E_USER_DEPRECATED);
        $this->approverLastName = $approverLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverEmail(): string
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated use getApproverRepresentativeEmail or getDcv', E_USER_DEPRECATED);
        return $this->approverEmail;
    }

    /**
     * @param string $approverEmail
     * @return RenewRequest
     */
    public function setApproverEmail(string $approverEmail): RenewRequest
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated use setApproverRepresentativeEmail or addDcv', E_USER_DEPRECATED);
        $this->approverEmail = $approverEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverPhone(): string
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated use getApproverRepresentativePhone', E_USER_DEPRECATED);
        return $this->approverPhone;
    }

    /**
     * @param string $approverPhone
     * @return RenewRequest
     */
    public function setApproverPhone(string $approverPhone): RenewRequest
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated use setApproverRepresentativePhone', E_USER_DEPRECATED);
        $this->approverPhone = $approverPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverRepresentativePosition(): string
    {
        return $this->approverRepresentativePosition;
    }

    /**
     * @param string $appRepPosition
     * @return RenewRequest
     */
    public function setApproverRepresentativePosition(string $appRepPosition): RenewRequest
    {
        $this->approverRepresentativePosition = $appRepPosition;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverRepresentativeFirstName(): string
    {
        return $this->approverRepresentativeFirstName;
    }

    /**
     * @param string $appRepFirstName
     * @return RenewRequest
     */
    public function setApproverRepresentativeFirstName(string $appRepFirstName): RenewRequest
    {
        $this->approverRepresentativeFirstName = $appRepFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverRepresentativeLastName(): string
    {
        return $this->approverRepresentativeLastName;
    }

    /**
     * @param string $appRepLastName
     * @return RenewRequest
     */
    public function setApproverRepresentativeLastName(string $appRepLastName): RenewRequest
    {
        $this->approverRepresentativeLastName = $appRepLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverRepresentativeEmail(): string
    {
        return $this->approverRepresentativeEmail;
    }

    /**
     * @param string $appRepEmail
     * @return RenewRequest
     */
    public function setApproverRepresentativeEmail(string $appRepEmail): RenewRequest
    {
        $this->approverRepresentativeEmail = $appRepEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getApproverRepresentativePhone(): string
    {
        return $this->approverRepresentativePhone;
    }

    /**
     * @param string $appRepPhone
     * @return RenewRequest
     */
    public function setApproverRepresentativePhone(string $appRepPhone): RenewRequest
    {
        $this->approverRepresentativePhone = $appRepPhone;
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
     * @return RenewRequest
     */
    public function setKvk(string $kvk): RenewRequest
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
     * @return RenewRequest
     */
    public function setReference(string $reference): RenewRequest
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUniqueValueDcv(): ?string
    {
        return $this->uniqueValueDcv;
    }

    /**
     * @param string $uniqueValue
     * @return RenewRequest
     */
    public function setUniqueValueDcv(string $uniqueValue): RenewRequest
    {
        $this->uniqueValueDcv = $uniqueValue;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDisableFreeSan(): bool
    {
        return $this->disableFreeSan;
    }

    /**
     * @param bool $disableFreeSan
     * @return RenewRequest
     */
    public function setDisableFreeSan(bool $disableFreeSan): RenewRequest
    {
        $this->disableFreeSan = $disableFreeSan;
        return $this;
    }

    /**
     * @return array
     */
    public function getApiRequestBody(): array
    {
        $result = [];
        $result['product'] = $this->productId;
        $result['years'] = $this->years;
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
        if (!empty($this->province)) {
            $result['province'] = $this->province;
        }
        if (!empty($this->country)) {
            $result['country'] = $this->country;
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
        if (!empty($this->approverRepresentativePosition)) {
            $result['approverRepresentativePosition'] = $this->approverRepresentativePosition;
        }
        if (!empty($this->approverRepresentativeFirstName)) {
            $result['approverRepresentativeFirstName'] = $this->approverRepresentativeFirstName;
        }
        if (!empty($this->approverRepresentativeLastName)) {
            $result['approverRepresentativeLastName'] = $this->approverRepresentativeLastName;
        }
        if (!empty($this->approverRepresentativeEmail)) {
            $result['approverRepresentativeEmail'] = $this->approverRepresentativeEmail;
        }
        if (!empty($this->approverRepresentativePhone)) {
            $result['approverRepresentativePhone'] = $this->approverRepresentativePhone;
        }
        if (!empty($this->kvk)) {
            $result['kvk'] = $this->kvk;
        }
        if (!empty($this->reference)) {
            $result['reference'] = $this->reference;
        }
        if (!empty($this->uniqueValueDcv)) {
            $result['uniqueValueDcv'] = $this->uniqueValueDcv;
        }
        if (!empty($this->disableFreeSan)) {
            $result['disableFreeSan'] = $this->disableFreeSan;
        }

        return $result;
    }
}
