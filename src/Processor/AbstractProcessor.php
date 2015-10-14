<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Result\Result;

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
     * @param mixed $data
     * @param array $options
     *
     * @return Result
     */
    abstract public function process($data, array $options = []);

    /**
     * getOption
     *
     * @param string $key
     * @param array  $options
     * @param null   $default
     *
     * @return null
     */
    protected function getOption($key, array $options, $default = null)
    {
        if (array_key_exists($key, $options)) {
            return $options[$key];
        }

        return $default;
    }
}
