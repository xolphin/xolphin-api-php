<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use Exception;

class Notes extends Base
{
    /**
     * @var array
     */
    public array $notes = [];

    /**
     * Notes constructor.
     * @param object $data
     * @throws Exception
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            if (!empty($this->_embedded->notes)) {
                foreach ($this->_embedded->notes as $note) {
                    $this->notes[] = new Note($note);
                }
            }
        }
    }
}
