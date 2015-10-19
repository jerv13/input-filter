<?php

namespace JervDesign\InputFilter\Zend\Factory;

use JervDesign\InputFilter\ResultParser\DefaultResultParser;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DefaultResultParserFactory
 */
class DefaultResultParserFactory implements FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $zendServiceLocator
     *
     * @return DefaultResultParser
     */
    public function createService(ServiceLocatorInterface $zendServiceLocator)
    {
        return new DefaultResultParser();
    }
}
