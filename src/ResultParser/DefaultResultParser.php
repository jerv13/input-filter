<?php

namespace Jerv\Validation\ResultParser;

use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\Result;

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
