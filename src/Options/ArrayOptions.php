<?php

namespace Jerv\Validation\Options;

/**
 * Class ArrayOptions
 */
class ArrayOptions implements Options
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->setOptions($options);
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
        if ($this->has($key)) {
            return $this->options[$key];
        }

        return $default;
    }

    /**
     * has
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->options);
    }

    /**
     * setOptions
     *
     * @param array $optionsData
     *
     * @return void
     */
    public function setOptions(array $optionsData)
    {
        $this->options = $optionsData;
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

        return $this->createOptions($value);
    }

    /**
     * createOptions
     *
     * @param array $optionsData
     *
     * @return Options
     */
    public function createOptions(array $optionsData)
    {
        return new ArrayOptions($optionsData);
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
        return $this->options;
    }
}
