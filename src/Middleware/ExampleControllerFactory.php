<?php

namespace Jerv\Validation\Middleware;

use Interop\Container\ContainerInterface;
use Jerv\Validation\Service\InputFilterService;

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
    public function __invoke($container)
    {
        return new ExampleController(
            $container->get('config'),
            $container->get(InputFilterService::class)
        );
    }
}
