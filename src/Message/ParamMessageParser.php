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
     * @param string $message
     * @param array  $options
     *
     * @return string
     */
    public function parse($message, array $options = [])
    {
        if (!array_key_exists('messageParams', $options)) {
            return $message;
        }
        $params = $options['messageParams'];

        foreach ($params as $name => $value) {
            $message = str_replace(
                '{' . $name . '}',
                $value,
                $message
            );
        }

        return $message;
    }
}
