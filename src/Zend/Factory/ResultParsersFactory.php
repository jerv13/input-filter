<?php

namespace Jerv\Validation\Zend\Factory;

use Jerv\Validation\ResultParser\ResultParsers;
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
    public function __($container)
    {
        /** @var \Jerv\Validation\ServiceLocator $serviceLocator */
        $serviceLocator = $container->get(\Jerv\Validation\ServiceLocator::class);
        $config = $container->get('config');
        $parserConfig = $config['Jerv\\Validation']['resultParsers'];

        return new ResultParsers($serviceLocator, $parserConfig);
    }
}
