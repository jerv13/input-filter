<?php

namespace Jerv\Validation\Options;

/**
 * Interface Options
 */
interface Options
{
    /**
     * set
     *
     * @param $key
     * @param $value
     *
     * @return void
     */
    public function set($key, $value);

    /**
     * get
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * has
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key);

    /**
     * setOptions
     *
     * @param array $optionsData
     *
     * @return mixed
     */
    public function setOptions(array $optionsData);

    /**
     * getOptions
     *
     * @param $key
     *
     * @return Options
     */
    public function getOptions($key);

    /**
     * createOptions
     *
     * @param array $optionsData
     *
     * @return Options
     */
    public function createOptions(array $optionsData);

    /**
     * toArray
     *
     * @param array $ignore
     *
     * @return array
     */
    public function toArray($ignore = []);
}
