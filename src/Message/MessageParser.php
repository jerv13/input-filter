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
     * @param string $string
     * @param array $options
     *
     * @return string
     */
    public function parse($string, $options = []);
}
