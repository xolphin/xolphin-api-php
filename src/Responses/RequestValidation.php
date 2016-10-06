<?php

namespace Xolphin\Responses;

class RequestValidation {
    /** @var boolean */
    public $status;

    /** @var int */
    public $statusDetail;

    /** @var string */
    public $statusMessage;

    /** @var RequestValidationDomain[] */
    public $domains = [];

    /**
     * RequestValidation constructor.
     * @param object $data
     */
    public function __construct($data) {
        if(isset($data->status)) $this->status = (bool)$data->status;
        if(isset($data->statusDetail)) $this->statusDetail = (int)$data->statusDetail;
        if(isset($data->statusMessage)) $this->statusMessage = (string)$data->statusMessage;

        if(!empty($data->domains)) {
            foreach($data->domains as $domain) {
                $this->domains[] = new RequestValidationDomain($domain);
            }
        }
    }
}