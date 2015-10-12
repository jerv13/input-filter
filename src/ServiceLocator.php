<?php

namespace JervDesign\InputFilter;

/**
 * Interface ServiceLocator
 */
interface ServiceLocator
{
    /**
     * get
     *
     * @param $id
     *
     * @return mixed
     */
    public function get($id);
}
