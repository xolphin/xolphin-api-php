<?php

namespace Xolphin\Requests;

class RequestEERequest
{
    /** @var string */
    protected $csr;

    /** @var  string */
    protected $approverEmail;

    /** @var string */
    protected $approverFirstName;

    /** @var string */
    protected $approverLastName;

    /** @var string */
    protected $approverPhone;

    /** @var string[] */
    protected $subjectAlternativeNames;

    /** @var  bool */
    protected $validate = false;

    /**
     * @var string
     *
     * possible values: 'FILE', 'DNS'
     */
    protected $dcvType;

    /**
     * @return string
     */
    public function getCsr(): string
    {
        return $this->csr;
    }

    /**
     * @return string
     */
    public function getApproverEmail(): string
    {
        return $this->approverEmail;
    }

    /**
     * @return string
     */
    public function getApproverFirstName(): string
    {
        return $this->approverFirstName;
    }

    /**
     * @return string
     */
    public function getApproverLastName(): string
    {
        return $this->approverLastName;
    }

    /**
     * @return string
     */
    public function getApproverPhone(): string
    {
        return $this->approverPhone;
    }

    /**
     * @return string
     */
    public function getDcvType(): string
    {
        return $this->dcvType;
    }

    /**
     * @return array
     */
    public function getSubjectAlternativeNames()
    {
        return $this->subjectAlternativeNames;
    }

    /**
     * @param string $csr
     * @return RequestEERequest
     */
    public function setCsr(string $csr): RequestEERequest
    {
        $this->csr = $csr;
        return $this;
    }

    /**
     * @param string $approverEmail
     * @return RequestEERequest
     */
    public function setApproverEmail(string $approverEmail): RequestEERequest
    {
        $this->approverEmail = $approverEmail;
        return $this;
    }

    /**
     * @param string $approverFirstName
     * @return RequestEERequest
     */
    public function setApproverFirstName(string $approverFirstName): RequestEERequest
    {
        $this->approverFirstName = $approverFirstName;
        return $this;
    }

    /**
     * @param string $approverLastName
     * @return RequestEERequest
     */
    public function setApproverLastName(string $approverLastName): RequestEERequest
    {
        $this->approverLastName = $approverLastName;
        return $this;
    }

    /**
     * @param string $approverPhone
     * @return RequestEERequest
     */
    public function setApproverPhone(string $approverPhone): RequestEERequest
    {
        $this->approverPhone = $approverPhone;
        return $this;
    }

    /**
     * @param string[] $subjectAlternativeNames
     * @return RequestEERequest
     */
    public function setSubjectAlternativeNames(array $subjectAlternativeNames): RequestEERequest
    {
        $this->subjectAlternativeNames = $subjectAlternativeNames;
        return $this;
    }

    /**
     * @param bool $validate
     * @return RequestEERequest
     */
    public function setValidate(bool $validate): RequestEERequest
    {
        $this->validate = $validate;
        return $this;
    }

    /**
     * @param string $dcvType use one of the following: EMAIL_VALIDATION, FILE_VALIDATION, DNS_VALIDATION
     * @return RequestEERequest
     */
    public function setDcvType(string $dcvType): RequestEERequest
    {
        $this->dcvType = $dcvType;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isValidate()
    {
        return $this->validate;
    }


    /**
     * Array representation
     *
     * @return array
     */
    public function getApiRequestBody()
    {
        $result = [
            'csr' => $this->getCsr(),
            'approverEmail' => $this->getApproverEmail(),
            'approverFirstName' => $this->getApproverFirstName(),
            'approverLastName' => $this->getApproverLastName(),
            'approverPhone' => $this->getApproverPhone(),
            'dcvType' => $this->getDcvType(),
            'validate' => $this->isValidate()
        ];

        if (!empty($this->subjectAlternativeNames)) {
            $result['subjectAlternativeNames'] = implode(',', $this->subjectAlternativeNames);
        }

        return $result;
    }
}