<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use Xolphin\Helpers\DCVTypes;

class RequestValidationDomain
{
    /** @var string */
    public string $domain;

    /** @var bool */
    public bool $status;

    /** @var int */
    public int $statusDetail;

    /** @var string */
    public string $statusMessage;

    /** @var string */
    public string $dcvType;

    /** @var string */
    public string $dcvEmail;

    /** @var string */
    public string $dnsRecord;

    /** @var string */
    public string $dnsCnameValue;

    /** @var string */
    public string $fileLocation;

    /** @var string */
    public string $fileContents;

    /**
     * RequestValidationDomain constructor.
     * @param object $data
     */
    public function __construct($data)
    {
        if (isset($data->domain)) {
            $this->domain = $data->domain;
        }
        if (isset($data->status)) {
            $this->status = (bool) $data->status;
        }
        if (isset($data->statusDetail)) {
            $this->statusDetail = (int) $data->statusDetail;
        }
        if (isset($data->statusMessage)) {
            $this->statusMessage = $data->statusMessage;
        }
        if (isset($data->dcvType)) {
            $this->dcvType = $data->dcvType;
        }

        if (isset($data->dcvType)) {
            if ($data->dcvType === DCVTypes::FILE_VALIDATION) {
                if (isset($data->fileLocation)) {
                    $this->fileLocation = $data->fileLocation;
                }
                if (isset($data->fileContents)) {
                    $this->fileContents = $data->fileContents;
                }
            } elseif ($data->dcvType === DCVTypes::DNS_VALIDATION) {
                if (isset($data->dnsRecord)) {
                    $this->dnsRecord = $data->dnsRecord;
                }
                if (isset($data->dnsCnameValue)) {
                    $this->dnsCnameValue = $data->dnsCnameValue;
                }
            } elseif ($data->dcvType === DCVTypes::EMAIL_VALIDATION) {
                if (isset($data->dcvEmail)) {
                    $this->dcvEmail = $data->dcvEmail;
                }
            }
        }
    }
}
