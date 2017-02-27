<?php

namespace Jerv\Validation\Processor;

use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\Result;

/**
 * Interface Processor
 */
interface Processor
{
    /**
     * process Filter and/or Validate
     *
     * @param mixed   $data
     * @param Options $options
     *
     * @return Result
     */
    public function process($data, Options $options);
}
