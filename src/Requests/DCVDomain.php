<?php

namespace Xolphin\Requests;

class DCVDomain
{
    /** @var string */
    public $domain;

    /** @var string */
    public $dcvType;

    /** @var string */
    public $approverEmail;

    /**
     * DCVDomain constructor.
     * @param string $domain
     * @param string $dcvType use one of the following: EMAIL_VALIDATION, FILE_VALIDATION, DNS_VALIDATION
     * @param string $approverEmail
     */
    public function __construct(string $domain, string $dcvType, string $approverEmail = "")
    {
        $this->domain = $domain;
        $this->dcvType = $dcvType;
        $this->approverEmail = $approverEmail;
    }
}