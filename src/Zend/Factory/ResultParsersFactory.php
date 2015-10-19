<?php

namespace JervDesign\InputFilter\Zend\Factory;

use JervDesign\InputFilter\ResultParser\DefaultResultParser;
use JervDesign\InputFilter\ResultParser\ResultParsers;
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
        /** @var \JervDesign\InputFilter\ServiceLocator $serviceLocator */
        $serviceLocator = $zendServiceLocator->get('JervDesign\InputFilter\ServiceLocator');
        $config = $zendServiceLocator->get('config');
        $parserConfig = $config['JervDesign\\InputFilter']['resultParsers'];

        return new ResultParsers($serviceLocator, $parserConfig);
    }
}
