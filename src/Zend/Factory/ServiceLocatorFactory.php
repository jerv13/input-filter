<?php

namespace JervDesign\InputFilter\Zend\Factory;

use JervDesign\Zend\ServiceManger\Adapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ServiceLocatorFactory
 */
class ServiceLocatorFactory implements FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $zendServiceLocator
     *
     * @return Adapter
     */
    public function createService(ServiceLocatorInterface $zendServiceLocator)
    {
        return new Adapter($zendServiceLocator);
    }
}
