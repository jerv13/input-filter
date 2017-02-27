<?php

namespace Jerv\Validation\Zend\Factory;

use Jerv\Validation\Zend\Validator\Adapter;
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
