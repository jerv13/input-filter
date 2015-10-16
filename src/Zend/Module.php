<?php
/**
 * Module Config For ZF2
 */

namespace JervDesign\InputFilter\Zend;

/**
 * Class Module
 */
class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/zendmodule.config.php';
    }
}
