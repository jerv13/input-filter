<?php

namespace JervDesign\InputFilter\Result;

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
    protected $value;

    /**
     * @var string
     */
    protected $message = '';

    /**
     * @var bool
     */
    protected $valid = true;

    /**
     * @var array
     */
    protected $children = [];

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
     * addResult
     *
     * @param Result $result
     *
     * @return void
     */
    public function addChild(Result $result)
    {
        // only add invalid results
        if ($result->isValid()) {
            return;
        }
        $this->children[] = $result;
    }

    /**
     * getChildren
     *
     * @return array [Result]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * mergeChildren
     *
     * @param Result $result
     *
     * @return mixed
     */
    public function mergeChildren(
        Result $result
    ) {
        // only merge invalid results
        if ($result->isValid()) {
            return;
        }

        $this->children = array_merge($result->getChildren(), $this->children);
    }

    /**
     * getMessages
     *
     * @param null   $results
     * @param string $ns
     * @param array  $messages
     *
     * @return array
     */
    public function getMessages($results = null, $ns = '', $messages = [])
    {
        if ($results === null) {
            $results = $this->children;
        }

        if (empty($ns)) {
            $ns = $this->getName();
        }

        /** @var Result $result */
        foreach ($results as $result) {
            $subNs = $ns . '-' . $result->getName();

            $messages = $this->getMessages(
                $result->getChildren(),
                $subNs,
                $messages
            );
        }

        return $messages;
    }

    /**
     * toString
     *
     * @param string $separator
     *
     * @return string
     */
    public function toString($separator = ' | ')
    {
        $messages = $this->getMessages();

        $messageString = ''; //implode($separator, $messages);

        foreach ($messages as $key => $message) {
            $messageString .= $message . $separator;
        }

        return $messageString;
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * toArray
     *
     * @param array $ignore
     *
     * @return void
     */
    public function toArray($ignore = [])
    {
        // @todo
    }
}
