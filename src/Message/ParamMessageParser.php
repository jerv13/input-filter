<?php

namespace JervDesign\InputFilter\Message;

/**
 * Class ParamsMessageParser
 */
class ParamsMessageParser implements MessageParser
{
    /**
     * string
     */
    const MESSAGE_PARAMS_KEY = 'messageParams';

    /**
     * parse
     *
     * @param string $code
     * @param string $message
     * @param array  $options
     *
     * @return mixed|string
     */
    public function parse($code, $message, array $options = [])
    {
        if (!array_key_exists(self::MESSAGE_PARAMS_KEY, $options)) {
            return $message;
        }

        $messageParams = $options[self::MESSAGE_PARAMS_KEY];

        if (!array_key_exists($code, $messageParams)) {
            return $message;
        }

        $params = $options[self::MESSAGE_PARAMS_KEY][$code];

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
