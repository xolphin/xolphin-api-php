<?php

declare(strict_types=1);

namespace Xolphin\Requests\Contracts;

interface ApiRequestInterface
{
    /**
     * Transforming the ValueObject into the body for an API request.
     *
     * @return array
     */
    public function getApiRequestBody(): array;
}