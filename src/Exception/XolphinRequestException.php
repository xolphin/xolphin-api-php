<?php

namespace Xolphin\Exception;

use GuzzleHttp\Exception\RequestException;

class XolphinRequestException extends \Exception
{
    /** @var mixed */
    private $errors;

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param RequestException $requestException
     *
     * @return XolphinRequestException
     */
    public static function createFromRequestException(RequestException $requestException)
    {
        $data = json_decode($requestException->getResponse()->getBody());

        if ($data == null) {
            return new self($requestException->getResponse()->getBody(), null, $requestException);
        }

        if (!isset($data->message)) {
            return new self($requestException->getMessage(), $requestException->getCode());
        }

        $customException         = new self($data->message, $requestException->getCode(), $requestException);
        $customException->errors = (isset($data->errors)) ? $data->errors : null;

        return $customException;
    }
}
