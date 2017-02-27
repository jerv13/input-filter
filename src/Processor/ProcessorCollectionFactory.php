<?php

namespace Jerv\Validation\Processor;

use Jerv\Validation\Processor\ProcessorCollection;
use Jerv\Validation\ServiceLocator;
use Psr\Container\ContainerInterface;

/**
 * Class ProcessorCollectionFactory
 */
class ProcessorCollectionFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return ProcessorCollection
     */
    public function __invoke($container)
    {
        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = $container->get(ServiceLocator::class);

        return new ProcessorCollection($serviceLocator);
    }
}
