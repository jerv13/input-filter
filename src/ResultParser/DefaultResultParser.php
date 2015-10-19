<?php

namespace JervDesign\InputFilter\Message;

/**
 * Class DefaultResultParser Returns unchanged result
 */
class DefaultResultParser implements ResultParser
{
    /**
     * parse
     *
     * @param string $code
     * @param string $message
     * @param array  $options
     *
     * @return string
     */
    public function parse($code, $message, array $options = [])
    {
        return $message;
    }
}
