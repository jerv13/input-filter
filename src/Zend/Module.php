<?php

namespace Jerv\Validation\Zend;

/**
 * Class Module for ZF2
 */
class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/zendmodule.config.php';
    }
}
