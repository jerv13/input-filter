<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Message\DefaultMessageParser;
use JervDesign\InputFilter\Message\MessageParser;
use JervDesign\InputFilter\Result\Result;

/**
 * Class AbstractProcessor
 */
abstract class AbstractProcessor implements Processor
{
    /**
     * string
     */
    static $defaultMessages
        = [
            'default' => 'Invalid'
        ];

    /**
     * @var MessageParser
     */
    protected $messageParser = null;

    /**
     * @param MessageParser|null $messageParser
     */
    public function __construct($messageParser = null)
    {
        if (empty($messageParser)) {
            $messageParser = new DefaultMessageParser();
        }
        $this->setMessageParser($messageParser);
    }

    /**
     * process Filter and/or Validate
     *
     * @param mixed $data
     * @param array $options
     *
     * @return Result
     */
    abstract public function process($data, array $options = []);

    /**
     * getMessage
     *
     * @param string $code
     * @param array  $options
     *
     * @return string
     */
    public function getMessage($code, array $options, $default = null)
    {
        if (empty($default)) {
            $default = self::$defaultMessages['default'];
        }
        $messageOptions = $this->getOption('messages', $options, []);
        $message = $this->getOption(
            (string)$code,
            $messageOptions,
            $default
        );

        return $this->getMessageParser()->parse($code, $message, $options);
    }

    /**
     * setMessageParser
     *
     * @param MessageParser $messageParser
     *
     * @return void
     */
    public function setMessageParser(MessageParser $messageParser)
    {
        $this->messageParser = $messageParser;
    }

    /**
     * getMessageParser
     *
     * @return MessageParser
     */
    public function getMessageParser()
    {
        return $this->messageParser;
    }

    /**
     * getOption
     *
     * @param string $key
     * @param array  $options
     * @param null   $default
     *
     * @return null
     */
    protected function getOption($key, array $options, $default = null)
    {
        if (array_key_exists($key, $options)) {
            return $options[$key];
        }

        return $default;
    }
}
