<?php

namespace Jerv\Validation\Zend\Factory;

use Jerv\Validation\Processor\ProcessorCollection;
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
    public function __($container)
    {
        /** @var \Jerv\Validation\ServiceLocator $serviceLocator */
        $serviceLocator = $container->get('Jerv\Validation\ServiceLocator');

        return new ProcessorCollection($serviceLocator);
    }
}
