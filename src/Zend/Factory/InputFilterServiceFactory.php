<?php

namespace Jerv\Validation\Zend\Factory;

use Jerv\Validation\Service\InputFilterService;
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
        $serviceLocator = $container->get(\Jerv\Validation\ServiceLocator::class);

        return new InputFilterService($serviceLocator);
    }
}
