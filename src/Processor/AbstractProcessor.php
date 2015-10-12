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
     * @var string
     */
    protected $messages = [
        'default' => 'Invalid'
    ];

    /**
     * @var MessageParser
     */
    protected $messageParser;

    /**
     * process Filter and/or Validate
     *
     * @param mixed $data
     * @param array $options
     *
     * @return Result
     */
    abstract public function process($data, $options = []);

    /**
     * getOption
     *
     * @param string $key
     * @param array  $options
     * @param null   $default
     *
     * @return null
     */
    protected function getOption($key, $options, $default = null)
    {
        if (array_key_exists($key, $options)) {
            return $options[$key];
        }

        return $default;
    }

    /**
     * getMessageParser
     *
     * @return MessageParser
     */
    protected function getMessageParser()
    {
        return new DefaultMessageParser();
    }

    /**
     * getMessage
     *
     * @param $name
     * @param $options
     * @param $default
     *
     * @return string
     */
    protected function getMessage($name, $options, $default)
    {
        return $this->messageParser->parse();
    }
}
