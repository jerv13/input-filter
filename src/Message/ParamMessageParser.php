<?php

namespace JervDesign\InputFilter\Message;

/**
 * Class ParamsMessageParser
 */
class ParamsMessageParser implements MessageParser
{
    /**
     * parseParams
     *
     * @param string $string
     * @param array  $options
     *
     * @return string
     */
    public function parse($string, $options = [])
    {
        if (!array_key_exists('params', $options)) {
            return $string;
        }
        $params = $options['params'];

        foreach ($params as $name => $value) {
            $string = str_replace(
                '{' . $name . '}',
                $value,
                $string
            );
        }

        return $string;
    }
}
