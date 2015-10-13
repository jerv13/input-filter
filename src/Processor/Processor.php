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
    public function process($data, array $options = []);

    /**
     * getMessage
     *
     * @param string $code
     * @param array  $options
     *
     * @return string
     */
    public function getMessage($code, array $options);
}
