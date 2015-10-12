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
     * setName
     *
     * @param string $name
     *
     * @return mixed
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
     * @return mixed
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
