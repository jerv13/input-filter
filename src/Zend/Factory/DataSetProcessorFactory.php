<?php

namespace Jerv\Validation\Zend\Factory;

use Jerv\Validation\Processor\DataSetProcessor;
use Psr\Container\ContainerInterface;

/**
 * Class DataSetProcessorFactory
 */
class DataSetProcessorFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return DataSetProcessor
     */
    public function __($container)
    {
        /** @var \Jerv\Validation\ServiceLocator $serviceLocator */
        $serviceLocator = $container->get('Jerv\Validation\ServiceLocator');

        return new DataSetProcessor($serviceLocator);
    }
}
