<?php
namespace Xolphin\Responses;

class RequestValidationDomain
{
    /** @var string */
    public $domain;

    /** @var boolean */
    public $status;

    /** @var int */
    public $statusDetail;

    /** @var string */
    public $statusMessage;

    /** @var string */
    public $dcvType;

    /** @var string */
    public $dcvEmail;

    /** @var string */
    public $dnsRecord;

    /** @var string */
    public $dnsCnameValue;

    /** @var string */
    public $fileLocation;

    /** @var string */
    public $fileContents;

    /**
     * RequestValidationDomain constructor.
     * @param object $data
     */
    public function __construct($data)
    {
        if(isset($data->domain)) $this->domain = $data->domain;
        if(isset($data->status)) $this->status = $data->status;
        if(isset($data->statusDetail)) $this->statusDetail = $data->statusDetail;
        if(isset($data->statusMessage)) $this->statusMessage = $data->statusMessage;
        if(isset($data->dcvType)) $this->dcvType = $data->dcvType;

        if(isset($data->dcvType)) {
            if($data->dcvType == 'FILE') {
                if(isset($data->fileLocation)) $this->fileLocation = $data->fileLocation;
                if(isset($data->fileContents)) $this->fileContents = $data->fileContents;
            } elseif($data->dcvType == 'DNS') {
                if(isset($data->dnsRecord)) $this->dnsRecord = $data->dnsRecord;
                if(isset($data->dnsCnameValue)) $this->dnsCnameValue = $data->dnsCnameValue;
            } elseif($data->dcvType == 'EMAIL') {
                if(isset($data->dcvEmail)) $this->dcvEmail = $data->dcvEmail;
            }
        }
    }
}
