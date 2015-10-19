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
    protected $code = '';

    /**
     * @var string
     */
    protected $name = 'default';

    /**
     * @var mixed
     */
    protected $value = null;

    /**
     * @var string
     */
    protected $message = '';

    /**
     * @var bool
     */
    protected $valid = true;

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
        $this->setCode((string)$code);
        $defaultMessage = $options->get('message', (string)$defaultMessage);

        if (empty($defaultMessage)) {
            $defaultMessage = 'Invalid';
        }

        $messages = $options->get('messages', []);

        if (empty($messages)) {
            $this->setMessage($defaultMessage);

            return;
        }

        if (!array_key_exists($code, $messages)) {
            $this->setMessage($defaultMessage);

            return;
        }

        $this->setMessage($messages[$code]);
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
        $this->setCode('');
        $this->setMessage('');
    }

    /**
     * setCode
     *
     * @param string $code
     *
     * @return void
     */
    public function setCode($code)
    {
        $code = (string)$code;

        $this->code = $code;
    }

    /**
     * getCode
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
     * @param string $message
     *
     * @return mixed
     */
    public function setMessage($message)
    {
        $this->message = (string)$message;
    }

    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
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

        if (!in_array('message', $ignore)) {
            $data['message'] = $this->getMessage();
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
