<?php

namespace Jerv\Validation\Zend\ServiceManager;

use Psr\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AdapterFactory
 */
class AdapterFactory
{
    /**
     * createService
     *
     * @param ContainerInterface|ServiceLocatorInterface $container
     *
     * @return Adapter
     */
    public function __($container)
    {
        return new Adapter($container);
    }
}
