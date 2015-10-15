<?php

namespace JervDesign\Zend\ServiceManger;

use JervDesign\InputFilter\ServiceLocator;
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
     * @param ServiceLocatorInterface $zendServiceLocator
     */
    public function __construct(ServiceLocatorInterface $zendServiceLocator)
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
