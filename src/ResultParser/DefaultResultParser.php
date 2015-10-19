<?php

namespace JervDesign\InputFilter\ResultParser;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Result\Result;

/**
 * Class DefaultResultParser Returns unchanged result
 */
class DefaultResultParser implements ResultParser
{
    /**
     * parse
     *
     * @param Result  $result
     * @param Options $options
     *
     * @return Result
     */
    public function parse(Result $result, Options $options)
    {
        return $result;
    }
}
