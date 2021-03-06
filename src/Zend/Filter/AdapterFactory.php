<?php

namespace Jerv\Validation\Zend\Filter;

use Psr\Container\ContainerInterface;

/**
 * Class AdapterFactory
 */
class AdapterFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return Adapter
     */
    public function __invoke($container)
    {
        return new Adapter();
    }
}
