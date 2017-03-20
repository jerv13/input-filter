<?php

namespace Jerv\Validation\Result;

use Jerv\Validation\Options\Options;
use Jerv\Validation\Processor\Processor;

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
     * @var mixed
     */
    protected $rawValue = null;

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
     * @var array
     */
    protected $results = [];

    /**
     * Constructor.
     *
     * @param           $name
     * @param           $rawValue
     * @param Processor $processor
     * @param bool      $valid
     */
    public function __construct(
        $name,
        $rawValue,
        Processor $processor,
        $valid = true
    ) {
        $this->setName($name);
        $this->setValid($valid);
        $this->setRawValue($rawValue);
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
     * setRawValue
     *
     * @param mixed $rawValue
     *
     * @return void
     */
    public function setRawValue($rawValue)
    {
        $this->rawValue = $rawValue;
    }

    /**
     * getRawValue
     *
     * @return mixed
     */
    public function getRawValue()
    {
        return $this->rawValue;
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
     * hasMessages
     *
     * @return bool
     */
    public function hasMessages()
    {
        return !empty($this->messages);
    }

    /**
     * setMessages
     *
     * @param array $messages
     *
     * @return void
     */
    public function setMessages(array $messages)
    {
        $this->messages = [];
        foreach ($messages as $code => $message) {
            $this->setMessage($code, $message);
        }
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
     * hasCode
     *
     * @param string $code
     *
     * @return bool
     */
    public function hasCode($code)
    {
        return array_key_exists($code, $this->messages);
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
        if (empty($this->messages)) {
            return '';
        }

        $this->messages[array_keys($this->messages)[0]];
    }

    /**
     * addResult
     *
     * @param Result $result
     *
     * @return void
     */
    public function addResult(Result $result)
    {
        // only add invalid results
        if ($result->isValid()) {
            return;
        }
        $this->results[] = $result;
    }

    /**
     * hasResults
     *
     * @return bool
     */
    public function hasResults()
    {
        return !empty($this->results);
    }

    /**
     * setResults
     *
     * @param array $results
     *
     * @return void
     */
    public function setResults(array $results)
    {
        $this->results = [];
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    /**
     * getResults
     *
     * @return array [Result]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * mergeResults
     *
     * @param Result $result
     *
     * @return void
     */
    public function mergeResults(
        Result $result
    ) {
        // only merge invalid results
        if ($result->isValid()) {
            return;
        }

        $this->results = array_merge(
            $result->getResults(),
            $this->results
        );
    }

    /**
     * toArray
     *
     * @param array $ignore
     *
     * @return array
     */
    public function toArray($ignore = ['processor'])
    {
        $data = [];

        if (!in_array('name', $ignore)) {
            $data['name'] = $this->getName();
        }

        if (!in_array('rawValue', $ignore)) {
            $data['rawValue'] = $this->getRawValue();
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

        if (!in_array('results', $ignore)) {
            $data['results'] = [];
            $results = $this->getResults();
            /** @var Result $result */
            foreach ($results as $result) {
                $data['results'][] = $result->toArray();
            }
        }

        return $data;
    }

}
