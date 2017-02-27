<?php

namespace Jerv\Validation\Zend\Factory;

use Jerv\Validation\Zend\ServiceManager\Adapter;
use Psr\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ServiceLocatorFactory
 */
class ServiceLocatorFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return ResultParsers
     */
    public function __($container)
    {
        return new Adapter($zendServiceLocator);
    }
}
