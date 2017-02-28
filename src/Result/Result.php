<?php

namespace Jerv\Validation\Result;

use Jerv\Validation\Arrayable;
use Jerv\Validation\Options\Options;
use Jerv\Validation\Stringable;

/**
 * Interface Result
 */
interface Result extends Stringable, Arrayable
{
    /**
     * setError
     * - Sets code and state
     * - Setting error implies an invalid result
     * - Builds messages based on options and defaultMessage
     *
     * @param string      $code
     * @param Options     $options
     * @param null|string $defaultMessage
     *
     * @return void
     */
    public function setError($code, Options $options, $defaultMessage = null);

    /**
     * setSuccess
     * - Sets value, code and state
     * - Setting a code creates a valid result
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setSuccess($value);

    /**
     * setName
     *
     * @param string $name
     *
     * @return void
     */
    public function setName($name);

    /**
     * getName
     *
     * @return string
     */
    public function getName();

    /**
     * setRawValue
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setRawValue($value);

    /**
     * getRawValue
     *
     * @return mixed
     */
    public function getRawValue();

    /**
     * setValue
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setValue($value);

    /**
     * getValue
     *
     * @return mixed
     */
    public function getValue();

    /**
     * setMessage
     *
     * @param string $code
     * @param string $message
     *
     * @return mixed
     */
    public function setMessage($code, $message);

    /**
     * getMessage
     *
     * @param $code
     *
     * @return mixed
     */
    public function getMessage($code);

    /**
     * hasMessages
     *
     * @return bool
     */
    public function hasMessages();

    /**
     * setMessages
     *
     * @param array $messages
     *
     * @return void
     */
    public function setMessages(array $messages);

    /**
     * getMessages
     *
     * @return array
     */
    public function getMessages();

    /**
     * hasCode
     *
     * @param string $code
     *
     * @return bool
     */
    public function hasCode($code);

    /**
     * isValid
     *
     * @return bool
     */
    public function isValid();

    /**
     * addResult
     *
     * @param Result $result
     *
     * @return void
     */
    public function addResult(Result $result);

    /**
     * setResults
     *
     * @param array $results
     *
     * @return void
     */
    public function setResults(array $results);

    /**
     * getResults
     *
     * @return array [Result]
     */
    public function getResults();

    /**
     * mergeResults
     *
     * @param Result $result
     *
     * @return void
     */
    public function mergeResults(
        Result $result
    );
}
