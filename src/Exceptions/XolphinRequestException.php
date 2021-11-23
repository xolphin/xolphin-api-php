<?php

declare(strict_types=1);

namespace Xolphin\Exceptions;

use Exception;
use GuzzleHttp\Exception\RequestException;

class XolphinRequestException extends Exception
{
    /** @var mixed */
    public $errors;

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param RequestException $requestException
     * @return XolphinRequestException
     */
    public static function createFromRequestException(RequestException $requestException): XolphinRequestException
    {
        $message = null;
        $code = null;
        $errors = null;

        if ($requestException->getResponse() !== null && $requestException->getResponse()->getBody() !== null) {
            $data = json_decode(
                $requestException->getResponse()->getBody()->getContents()
            );

            $message = !empty($data->message) ? $data->message : null;
            $errors = !empty($data->errors) ? $data->errors : null;
            $code = $requestException->getCode() ?? null;
        }

        $exception = new self($message ?? 'Unknown exception', $code ?? 0, $requestException);
        $exception->errors = $errors;

        return $exception;
    }
}