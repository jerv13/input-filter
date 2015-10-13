<?php

namespace JervDesign\InputFilter\Message;

/**
 * Class MessageParsers Composite MessageParser
 */
class MessageParsers implements MessageParser
{
    /**
     * array [MessageParser]
     */
    protected $messageParsers = [];

    /**
     * add
     *
     * @param MessageParser $messageParser
     *
     * @return void
     */
    public function add(MessageParser $messageParser)
    {
        $this->messageParsers[] = $messageParser;
    }

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
        /** @var MessageParser $messageParser */
        foreach ($this->messageParsers as $messageParser) {
            $message = $messageParser->parse($message);
        }

        return $message;
    }
}
