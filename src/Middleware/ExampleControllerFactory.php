<?php

namespace Jerv\Validation\Middleware;

use Interop\Container\ContainerInterface;

/**
 * Class ExampleControllerFactory
 *
 * @author    James Jervis
 * @license   License.txt
 * @link      https://github.com/jerv13
 */
class ExampleControllerFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return ExampleController
     */
    public function __($container)
    {
        return new ExampleController($container);
    }
}
