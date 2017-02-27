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
     * DEFAULT_CODE
     */
    const DEFAULT_CODE = 'invalid';

    /**
     * DEFAULT_CODE
     */
    const DEFAULT_MESSAGE = 'Data is invalid';

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
