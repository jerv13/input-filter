<?php

namespace JervDesign\InputFilter\Message;

/**
 * Class DefaultMessageParser Returns unchanged string
 */
class DefaultMessageParser implements MessageParser
{
    /**
     * parseParams
     *
     * @param string $message
     * @param array  $options
     *
     * @return string
     */
    public function parse($message, array $options = [])
    {
        return $message;
    }
}
