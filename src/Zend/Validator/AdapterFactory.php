<?php

namespace Jerv\Validation\Zend\Validator;

use Psr\Container\ContainerInterface;

/**
 * Class AdapterFactory
 */
class AdapterFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return Adapter
     */
    public function __($container)
    {
        return new Adapter();
    }
}
