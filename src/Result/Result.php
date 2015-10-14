<?php

namespace JervDesign\InputFilter\Result;

use JervDesign\InputFilter\Arrayable;
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
     * @param array       $options
     * @param null|string $defaultMessage
     *
     * @return void
     */
    public function setError($code, array $options = [], $defaultMessage = null);

    /**
     * setCode
     *
     * @param $code
     *
     * @return mixed
     */
    public function setCode($code);

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
     * @param string $message
     *
     * @return void
     */
    public function setMessage($message);

    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage();

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
     * @return mixed
     */
    public function mergeChildren(
        Result $result
    );
}
