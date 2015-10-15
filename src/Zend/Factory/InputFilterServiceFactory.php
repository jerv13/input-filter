<?php

namespace JervDesign\InputFilter\Zend\Factory;

use JervDesign\InputFilter\Service\InputFilterService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ProcessorCollectionFactory
 */
class ProcessorCollectionFactory implements FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $zendServiceLocator
     *
     * @return InputFilterService
     */
    public function createService(ServiceLocatorInterface $zendServiceLocator)
    {
        /** @var \JervDesign\InputFilter\ServiceLocator $serviceLocator */
        $serviceLocator = $zendServiceLocator->get('JervDesign\InputFilter\ServiceLocator');

        return new InputFilterService($serviceLocator);
    }
}
