<?php

namespace Jerv\Validation\ResultParser;

use Jerv\Validation\ServiceLocator;
use Psr\Container\ContainerInterface;

/**
 * Class ResultParserFactory
 */
class ResultParserFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return ResultParsers
     */
    public function __invoke($container)
    {
        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = $container->get(ServiceLocator::class);
        $config = $container->get('config');
        $parserConfig = $config['jerv-validation']['resultParsers'];

        return new ResultParsers($serviceLocator, $parserConfig);
    }
}
