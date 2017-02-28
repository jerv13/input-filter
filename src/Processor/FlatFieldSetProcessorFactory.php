<?php

namespace Jerv\Validation\Processor;

use Jerv\Validation\ServiceLocator;
use Psr\Container\ContainerInterface;

/**
 * Class FlatFieldSetProcessorFactory
 */
class FlatFieldSetProcessorFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return FlatFieldSetProcessor
     */
    public function __invoke($container)
    {
        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = $container->get(ServiceLocator::class);

        return new FlatFieldSetProcessor($serviceLocator);
    }
}
