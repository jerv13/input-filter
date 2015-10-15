<?php

namespace JervDesign\InputFilter\Zend\Factory;

use JervDesign\Zend\Filter\Adapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FilterAdapterFactory
 */
class FilterAdapterFactory implements FactoryInterface
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
        return new Adapter();
    }
}
