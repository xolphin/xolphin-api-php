<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use stdClass;

class SSLCheck extends Base
{
    /** @var string|null */
    public ?string $ifaceName = null;

    /** @var bool|null */
    public ?bool $passed = null;

    /** @var stdClass */
    public $tests;

    /** @var string|null */
    public ?string $fullJsonResult = null;

    /**
     * SSLCheck constructor.
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            if (isset($data->ifaceName)) {
                $this->ifaceName = $data->ifaceName;
            }
            if (isset($data->passed)) {
                $this->passed = (bool) $data->passed;
            }
            if (isset($data->tests)) {
                $this->tests = $data->tests;
            }
            if (isset($data)) {
                $this->fullJsonResult = json_encode($data);
            }
        }
    }
}
