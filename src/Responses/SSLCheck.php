<?php


namespace Xolphin\Responses;


use stdClass;

class SSLCheck extends Base
{
    /**
     * @var string
     */
    public $ifaceName;
    /**
     * @var boolean
     */
    public $passed;
    /**
     * @var stdClass
     */
    public $tests;
    /**
     * @var string
     */
    public $fullJsonResult;


    /**
     * SSLCheck constructor.
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if(!$this->isError()) {
            if(isset($data->ifaceName)) $this->ifaceName = $data->ifaceName;
            if(isset($data->passed)) $this->passed = $data->passed;
            if(isset($data->tests)) $this->tests = $data->tests;
            if(isset($data)) $this->fullJsonResult = json_encode($data);
        }
    }
}