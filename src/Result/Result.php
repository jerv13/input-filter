<?php

namespace JervDesign\InputFilter\Result;

use JervDesign\InputFilter\Arrayable;
use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Stringable;

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
     * getCode
     *
     * @return string
     */
    public function getCode();

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
     * getMessages
     *
     * @return array
     */
    public function getMessages();

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
    public function addChild(Result $result);

    /**
     * getChildren
     *
     * @return array [Result]
     */
    public function getChildren();

    /**
     * mergeChildren
     *
     * @param Result $result
     *
     * @return void
     */
    public function mergeChildren(
        Result $result
    );
}
