<?php
namespace Xolphin\Responses;

class RequestValidationDomain
{
    /** @var string */
    public $domain;

    /** @var string */
    public $dcvType;

    /** @var string */
    public $dcvEmail;

    /** @var boolean */
    public $status;

    /** @var int */
    public $statusDetail;

    /** @var string */
    public $statusMessage;

    /**
     * RequestValidationDomain constructor.
     * @param object $data
     */
    public function __construct($data)
    {
        if(isset($data->domain)) $this->domain = $data->domain;
        if(isset($data->dcvType)) $this->dcvType = $data->dcvType;
        if(isset($data->dcvEmail)) $this->dcvEmail = $data->dcvEmail;
        if(isset($data->status)) $this->status = $data->status;
        if(isset($data->statusDetail)) $this->statusDetail = $data->statusDetail;
        if(isset($data->statusMessage)) $this->statusMessage = $data->statusMessage;
    }
}
