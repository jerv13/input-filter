<?php

namespace JervDesign\InputFilter\Options;

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
}