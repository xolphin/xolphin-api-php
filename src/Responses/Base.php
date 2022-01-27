<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class Base
{
    private ?Pagination $pagination = null;

    /** @var object */
    protected $_embedded;

    /** @var string|null */
    private ?string $message = null;

    /** @var mixed */
    private $errors;

    /**
     * BaseResponse constructor.
     * @param object $data
     */
    public function __construct($data)
    {
        if (isset($data->message)) {
            $this->message = $data->message;
        }
        if (isset($data->errors)) {
            $this->errors = $data->errors;
        }

        if (isset($data->page) || isset($data->limit) || isset($data->pages) || isset($data->total)) {
            $this->pagination = new Pagination();

            if (isset($data->page)) {
                $this->pagination->setpage((int) $data->page);
            }
            if (isset($data->limit)) {
                $this->pagination->setLimit((int) $data->limit);
            }
            if (isset($data->pages)) {
                $this->pagination->setPages((int) $data->pages);
            }
            if (isset($data->total)) {
                $this->pagination->setTotal((int) $data->total);
            }
        }

        if (isset($data->_embedded)) {
            $this->_embedded = $data->_embedded;
        }
    }

    /**
     * Returns true if there is an error
     * @return bool
     */
    public function isError(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Error about current request
     * Not null when response code != 200
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getErrorData()
    {
        return $this->errors;
    }

    /**
     * @return Pagination|null
     */
    public function getPagination(): ?Pagination
    {
        return $this->pagination;
    }
}
