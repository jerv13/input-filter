<?php

namespace Jerv\Validation\Processor;

use Jerv\Validation\ServiceLocator;
use Psr\Container\ContainerInterface;

/**
 * Class FieldSetProcessorFactory
 */
class FieldSetProcessorFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return FieldSetProcessor
     */
    public function __invoke($container)
    {
        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = $container->get(ServiceLocator::class);

        return new FieldSetProcessor($serviceLocator);
    }
}
