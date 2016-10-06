<?php

namespace Xolphin\Responses;

class Notes extends Base{

    /**
     * @var array
     */
    public $notes = [];

    /**
     * Notes constructor.
     * @param object $data
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if(!$this->isError()) {
            if(!empty($this->_embedded->notes))
                foreach($this->_embedded->notes as $note) {
                    $this->notes[] = new Note($note);
                }
        }

    }

}