<?php

namespace JervDesign\InputFilter\Message;

/**
 * Class MessageParser
 */
interface MessageParser
{
    /**
     * parseParams
     *
     * @param string $message
     * @param array  $options
     *
     * @return string
     */
    public function parse($message, array $options = []);
}
