<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\Result\ResultCollection;

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
