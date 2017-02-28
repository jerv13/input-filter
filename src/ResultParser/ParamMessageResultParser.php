<?php

namespace Jerv\Validation\ResultParser;

use Jerv\Validation\Options\ArrayOptions;
use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\Result;

/**
 * Class ParamMessageResultParser
 */
class ParamMessageResultParser implements ResultParser
{
    /**
     * string
     */
    const MESSAGE_PARAMS_KEY = 'messageParams';

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
        $messageParams = $options->get(self::MESSAGE_PARAMS_KEY, null);

        if ($messageParams === null) {
            return $result;
        }

        $messageParamOptions = new ArrayOptions();
        $messageParamOptions->setOptions($messageParams);

        $messages = $result->getMessages();

        foreach ($messages as $code => $message) {
            $codeMessage = $messageParamOptions->get($code, null);

            if ($codeMessage === null) {
                continue;
            }

            $result->setMessage($code, $this->buildMessage($message, $messageParams));
        }

        return $result;
    }

    /**
     * buildMessage
     *
     * @param string $message
     * @param array  $params
     *
     * @return string
     */
    public function buildMessage($message, $params)
    {
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
