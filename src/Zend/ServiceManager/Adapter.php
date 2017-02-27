<?php

namespace Jerv\Validation\Zend\ServiceManager;

use Jerv\Validation\ServiceLocator;
use Psr\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Adapter
 */
class Adapter implements ServiceLocator
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $zendServiceLocator;

    /**
     * @param ContainerInterface|ServiceLocatorInterface $zendServiceLocator
     */
    public function __construct($zendServiceLocator)
    {
        $this->zendServiceLocator = $zendServiceLocator;
    }

    /**
     * Retrieve a registered instance
     *
     * @param  string $name
     *
     * @throws \Exception
     * @return object|array
     */
    public function get($name)
    {
        return $this->zendServiceLocator->get($name);
    }

    /**
     * Check for a registered instance
     *
     * @param  string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return $this->zendServiceLocator->has($name);
    }
}
