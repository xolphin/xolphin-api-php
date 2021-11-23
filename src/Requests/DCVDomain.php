<?php

declare(strict_types=1);

namespace Xolphin\Requests;

class DCVDomain
{
    /** @var string */
    public string $domain;

    /** @var string */
    public string $dcvType;

    /** @var string|null */
    public ?string $approverEmail;

    /**
     * DCVDomain constructor.
     * @param string $domain
     * @param string $dcvType use one of the following: EMAIL_VALIDATION, FILE_VALIDATION, DNS_VALIDATION
     * @param string|null $approverEmail
     */
    public function __construct(string $domain, string $dcvType, ?string $approverEmail = null)
    {
        $this->domain = $domain;
        $this->dcvType = $dcvType;
        $this->approverEmail = $approverEmail;
    }
}