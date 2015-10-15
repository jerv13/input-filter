<?php

namespace JervDesign\InputFilter;

/**
 * Interface ServiceLocator
 */
interface ServiceLocator
{
    /**
     * Retrieve a registered instance
     *
     * @param  string  $name
     * @throws \Exception
     * @return object|array
     */
    public function get($name);

    /**
     * Check for a registered instance
     *
     * @param  string|array  $name
     * @return bool
     */
    public function has($name);
}
