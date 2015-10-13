<?php

namespace JervDesign\InputFilter\Message;

/**
 * Class MessageParser
 */
interface MessageParser
{
    /**
     * parse
     *
     * @param string $code
     * @param string $message
     * @param array  $options
     *
     * @return mixed
     */
    public function parse($code, $message, array $options = []);
}
