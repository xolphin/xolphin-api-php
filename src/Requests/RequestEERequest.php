<?php

declare(strict_types=1);

namespace Xolphin\Requests;

use Xolphin\Requests\Contracts\ApiRequestInterface;

class RequestEERequest implements ApiRequestInterface
{
    /** @var string */
    protected string $csr;

    /** @var  string */
    protected string $approverEmail;

    /** @var string */
    protected string $approverFirstName;

    /** @var string */
    protected string $approverLastName;

    /** @var string */
    protected string $approverPhone;

    /** @var string[] */
    protected array $subjectAlternativeNames;

    /** @var  bool */
    protected bool $validate = false;

    /**
     * Possible values: 'FILE', 'DNS'
     *
     * @var string
     */
    protected string $dcvType;

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
    public function getSubjectAlternativeNames(): array
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
     * @return bool
     */
    public function isValidate(): bool
    {
        return $this->validate;
    }
    
    /**
     * Array representation
     *
     * @return array
     */
    public function getApiRequestBody(): array
    {
        $result = [
            'csr' => $this->csr,
            'approverEmail' => $this->approverEmail,
            'approverFirstName' => $this->approverFirstName,
            'approverLastName' => $this->approverLastName,
            'approverPhone' => $this->approverPhone,
            'dcvType' => $this->dcvType,
            'validate' => $this->validate,
        ];

        if (!empty($this->subjectAlternativeNames)) {
            $result['subjectAlternativeNames'] = implode(',', $this->subjectAlternativeNames);
        }

        return $result;
    }
}