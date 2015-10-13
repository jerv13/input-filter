<?php

namespace JervDesign\InputFilter\Message;

/**
 * Class DefaultMessageParser Returns unchanged string
 */
class DefaultMessageParser implements MessageParser
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
