<?php

namespace Jerv\Validation;

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
        $config = include __DIR__ . '/../config/module.config.php';

        return $config;
    }
}
