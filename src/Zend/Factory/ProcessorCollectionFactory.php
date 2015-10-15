<?php

namespace JervDesign\Zend\Factory;

use JervDesign\InputFilter\Processor\ProcessorCollection;
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
     * @return ProcessorCollection
     */
    public function createService(ServiceLocatorInterface $zendServiceLocator)
    {
        /** @var \JervDesign\InputFilter\ServiceLocator $serviceLocator */
        $serviceLocator = $zendServiceLocator->get('JervDesign\InputFilter\ServiceLocator');

        return new ProcessorCollection($serviceLocator);
    }
}
