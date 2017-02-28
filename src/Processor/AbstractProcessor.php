<?php

namespace Jerv\Validation\Processor;

use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\Result;

/**
 * Class AbstractProcessor
 */
abstract class AbstractProcessor implements Processor
{
    /**
     * process Filter and/or Validate
     *
     * @param mixed   $data
     * @param Options $options
     *
     * @return Result
     */
    abstract public function process($data, Options $options);
}
