<?php

namespace Xolphin\Requests;

class RequestDCV {
    /** @var string */
    public $domain;

    /** @var string */
    public $dcvType;

    /** @var string */
    public $approverEmail;

    /**
     * RequestDCV constructor.
     * @param $domain
     * @param $dcvType
     * @param string $approverEmail
     */
    public function __construct($domain, $dcvType, $approverEmail = "") {
        $this->domain = $domain;
        $this->dcvType = $dcvType;
        $this->approverEmail = $approverEmail;
    }
}
