<?php

declare(strict_types=1);

namespace Xolphin\Responses;

use Exception;

class Certificates extends Base
{
    /** @var Certificate[] */
    public array $certificates = [];

    /**
     * Certificates constructor.
     * @param object $data
     * @throws Exception
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (!$this->isError()) {
            if (!empty($this->_embedded->certificates)) {
                foreach ($this->_embedded->certificates as $certificate) {
                    $this->certificates[] = new Certificate($certificate);
                }
            }
        }
    }
}
