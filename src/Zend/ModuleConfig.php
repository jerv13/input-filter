<?php

namespace Jerv\Validation\Zend;

/**
 * Class ModuleConfig
 *
 */
class ModuleConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
