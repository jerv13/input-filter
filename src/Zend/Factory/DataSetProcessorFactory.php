<?php

namespace JervDesign\InputFilter\Zend\Factory;

use JervDesign\InputFilter\Processor\DataSetProcessor;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DataSetProcessorFactory
 */
class DataSetProcessorFactory implements FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $zendServiceLocator
     *
     * @return DataSetProcessor
     */
    public function createService(ServiceLocatorInterface $zendServiceLocator)
    {
        /** @var \JervDesign\InputFilter\ServiceLocator $serviceLocator */
        $serviceLocator = $zendServiceLocator->get('JervDesign\InputFilter\ServiceLocator');

        return new DataSetProcessor($serviceLocator);
    }
}
