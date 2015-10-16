<?php

namespace JervDesign\InputFilter\Options;

/**
 * Class ArrayOptions
 */
class ArrayOptions
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * set
     *
     * @param $key
     * @param $value
     *
     * @return void
     */
    public function set($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * get
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }

        return $default;
    }

    /**
     * getOptions
     *
     * @param $key
     *
     * @return ArrayOptions|mixed
     */
    public function getOptions($key)
    {
        $value = $this->get($key, []);

        if (is_array($value)) {
            return new ArrayOptions($value);
        }

        return $value;
    }
}
