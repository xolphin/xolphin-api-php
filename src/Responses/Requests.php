<?php

namespace Xolphin\Responses;

use Exception;

class Requests extends Base
{
    /** @var Request[] */
    public $requests = [];

    /**
     * Requests constructor.
     * @param object $data
     * @throws Exception
     */
    function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            foreach ($this->_embedded->requests as $request) {
                $this->requests[] = new Request($request);
            }
        }
    }
}
