<?php

namespace Jerv\Validation;

/**
 * Class Arrayable
 */
interface Arrayable
{
    /**
     * toArray
     *
     * @param array $ignore
     *
     * @return array
     */
    public function toArray($ignore = []);
}
