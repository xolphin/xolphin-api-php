<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class RequestValidation
{
    /** @var bool|null */
    public ?bool $status = null;

    /** @var int|null */
    public ?int $statusDetail = null;

    /** @var string|null */
    public ?string $statusMessage = null;

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
