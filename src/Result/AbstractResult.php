<?php

namespace JervDesign\InputFilter\Result;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Processor\Processor;

/**
 * Class AbstractResult
 */
abstract class AbstractResult implements Result
{
    /**
     * @var string
     */
    protected $name = 'default';

    /**
     * @var mixed
     */
    protected $value = null;

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * @var bool
     */
    protected $valid = true;

    /**
     * @var Processor|null
     */
    protected $processor = null;

    /**
     * @param           $name
     * @param bool|true $valid
     */
    public function __construct($name, Processor $processor, $valid = true)
    {
        $this->setName($name);
        $this->setValid($valid);
        $this->processor = $processor;
    }

    /**
     * setError
     * - Sets code and state
     * - Setting a code creates an invalid result
     *
     * @param string      $code
     * @param Options     $options
     * @param null|string $defaultMessage
     *
     * @return void
     */
    public function setError($code, Options $options, $defaultMessage = 'Invalid')
    {
        $this->setValid(false);
        $defaultMessage = $options->get('message', (string)$defaultMessage);

        if (empty($defaultMessage)) {
            $defaultMessage = 'Invalid';
        }

        $messages = $options->get('messages', []);

        if (empty($messages)) {
            $this->setMessage($code, $defaultMessage);

            return;
        }

        if (!array_key_exists($code, $messages)) {
            $this->setMessage($code, $defaultMessage);

            return;
        }

        $this->setMessage($code, $messages[$code]);
    }

    /**
     * setSuccess
     * - Sets value, code and state
     * - Setting a code creates a valid result
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setSuccess($value)
    {
        $this->setValid(true);
        $this->setValue($value);
        $this->messages = [];
    }

    /**
     * getCode
     *
     * @param string|null $default
     *
     * @return string|null
     */
    public function getCode($default = null)
    {
        if (empty($this->messages)) {
            return $default;
        }

        return array_keys($this->messages)[0];
    }

    /**
     * setName
     *
     * @param string $name
     *
     * @return mixed
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }

    /**
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * setValue
     *
     * @param $value
     *
     * @return mixed
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * getValue
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * setMessage
     *
     * @param string $code
     * @param string $message
     *
     * @return void
     */
    public function setMessage($code, $message)
    {
        $code = (string)$code;
        $this->messages[$code] = (string)$message;
    }

    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage($code, $default = null)
    {
        if (array_key_exists($code, $this->messages)) {
            return $this->messages[$code];
        }

        return $default;
    }

    /**
     * getMessages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * setValid
     *
     * @param $valid
     *
     * @return void
     */
    public function setValid($valid)
    {
        $this->valid = (bool)$valid;
    }

    /**
     * isValid
     *
     * @return bool
     */
    public function isValid()
    {
        return (bool)$this->valid;
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }

    /**
     * toArray
     *
     * @param array $ignore
     *
     * @return array
     */
    public function toArray($ignore = [])
    {
        $data = [];

        if (!in_array('code', $ignore)) {
            $data['code'] = $this->getCode();
        }

        if (!in_array('name', $ignore)) {
            $data['name'] = $this->getName();
        }

        if (!in_array('value', $ignore)) {
            $data['value'] = $this->getValue();
        }

        if (!in_array('messages', $ignore)) {
            $data['messages'] = $this->getMessages();
        }

        if (!in_array('valid', $ignore)) {
            $data['valid'] = $this->isValid();
        }

        if (!in_array('processor', $ignore)) {
            $data['processor'] = get_class($this->processor);
        }

        return $data;
    }
}
