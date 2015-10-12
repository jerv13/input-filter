<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Result\Result;

/**
 * Interface Processor
 */
interface Processor
{
    /**
     * process Filter and/or Validate
     *
     * @param mixed $data
     * @param array $options
     *
     * @return Result
     */
    public function process($data, $options = []);
}
