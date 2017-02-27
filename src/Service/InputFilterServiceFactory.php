<?php

namespace Jerv\Validation\Service;

use Jerv\Validation\ServiceLocator;
use Psr\Container\ContainerInterface;

/**
 * Class InputFilterServiceFactory
 */
class InputFilterServiceFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return InputFilterService
     */
    public function __($container)
    {
        /** @var \Jerv\Validation\ServiceLocator $serviceLocator */
        $serviceLocator = $container->get(ServiceLocator::class);

        return new InputFilterService($serviceLocator);
    }
}
