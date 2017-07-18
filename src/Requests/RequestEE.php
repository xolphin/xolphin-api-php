<?php

namespace Xolphin\Requests;

class RequestEE
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

    /** @var string */
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
    public function getCsr()
    {
        return $this->csr;
    }

    /**
     * @return string
     */
    public function getApproverEmail()
    {
        return $this->approverEmail;
    }

    /**
     * @return string
     */
    public function getApproverFirstName()
    {
        return $this->approverFirstName;
    }

    /**
     * @return string
     */
    public function getApproverLastName()
    {
        return $this->approverLastName;
    }

    /**
     * @return string
     */
    public function getApproverPhone()
    {
        return $this->approverPhone;
    }

    /**
     * @return string
     */
    public function getDcvType()
    {
        return $this->dcvType;
    }

    /**
     * @return string
     */
    public function getSubjectAlternativeNames()
    {
        return $this->subjectAlternativeNames;
    }

    /**
     * @param boolean $validate
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;
    }

    /**
     * @param string $csr
     */
    public function setCsr($csr)
    {
        $this->csr = $csr;
    }

    /**
     * @param string $approverEmail
     */
    public function setApproverEmail($approverEmail)
    {
        $this->approverEmail = $approverEmail;
    }

    /**
     * @param string $approverFirstName
     */
    public function setApproverFirstName($approverFirstName)
    {
        $this->approverFirstName = $approverFirstName;
    }

    /**
     * @param string $approverLastName
     */
    public function setApproverLastName($approverLastName)
    {
        $this->approverLastName = $approverLastName;
    }

    /**
     * @param string $approverPhone
     */
    public function setApproverPhone($approverPhone)
    {
        $this->approverPhone = $approverPhone;
    }

    /**
     * @param string $dcvType
     */
    public function setDcvType($dcvType)
    {
        $this->dcvType = $dcvType;
    }

    /**
     * @param string $subjectAlternativeNames
     */
    public function setSubjectAlternativeNames($subjectAlternativeNames)
    {
        $this->subjectAlternativeNames = $subjectAlternativeNames;
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
    public function getArray(){

        $return = [
            'csr'                       => $this->getCsr(),
            'approverEmail'             => $this->getApproverEmail(),
            'approverFirstName'         => $this->getApproverFirstName(),
            'approverLastName'          => $this->getApproverLastName(),
            'approverPhone'             => $this->getApproverPhone(),
            'dcvType'                   => $this->getDcvType(),
            'validate'                  => $this->isValidate()
        ];

        if(!empty($this->getSubjectAlternativeNames()))
            $return['subjectAlternativeNames'] = $this->getSubjectAlternativeNames();

        return $return;
    }
}