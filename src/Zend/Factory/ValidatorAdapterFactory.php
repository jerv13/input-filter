<?php

namespace JervDesign\InputFilter\Zend\Factory;

use JervDesign\Zend\Validator\Adapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ValidatorAdapterFactory
 */
class ValidatorAdapterFactory implements FactoryInterface
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
