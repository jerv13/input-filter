<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\Result\ProcessorResultCollection;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\Result\ResultCollection;

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
    abstract public function process($data, Options $options, ResultCollection $resultCollection = null);
}
