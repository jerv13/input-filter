<?php

namespace JervDesign\InputFilter\ResultParser;

use JervDesign\InputFilter\Options\ArrayOptions;
use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Result\Result;

/**
 * Class ParamsResultParser
 */
class ParamsResultParser implements ResultParser
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

        $messageParamOptions = new ArrayOptions($messageParams);

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
     * @param array $params
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
