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
        if(!empty($data->domain)) $this->domain = $data->domain;
        if(!empty($data->dcvType)) $this->dcvType = $data->dcvType;
        if(!empty($data->dcvEmail)) $this->dcvEmail = $data->dcvEmail;
        if(!empty($data->status)) $this->status = $data->status;
        if(!empty($data->statusDetail)) $this->statusDetail = $data->statusDetail;
        if(!empty($data->statusMessage)) $this->statusMessage = $data->statusMessage;
    }
}
