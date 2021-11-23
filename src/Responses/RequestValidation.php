<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class RequestValidation
{
    /** @var bool */
    public bool $status;

    /** @var int */
    public int $statusDetail;

    /** @var string */
    public string $statusMessage;

    /** @var RequestValidationDomain[] */
    public array $domains = [];

    /**
     * RequestValidation constructor.
     * @param object $data
     */
    public function __construct($data)
    {
        if (isset($data->status)) {
            $this->status = (bool) $data->status;
        }
        if (isset($data->statusDetail)) {
            $this->statusDetail = (int) $data->statusDetail;
        }
        if (isset($data->statusMessage)) {
            $this->statusMessage = (string) $data->statusMessage;
        }

        if (!empty($data->domains)) {
            foreach ($data->domains as $domain) {
                $this->domains[] = new RequestValidationDomain($domain);
            }
        }
    }
}
