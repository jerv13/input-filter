<?php

namespace Jerv\Validation\Zend\Factory;

use Jerv\Validation\Zend\Filter\Adapter;
use Psr\Container\ContainerInterface;

/**
 * Class FilterAdapterFactory
 */
class FilterAdapterFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return Adapter
     */
    public function __($container)
    {
        return new Adapter();
    }
}
