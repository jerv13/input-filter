<?php

namespace Jerv\Validation\ResultParser;

use Psr\Container\ContainerInterface;

/**
 * Class DefaultResultParserFactory
 */
class DefaultResultParserFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return DefaultResultParser
     */
    public function __invoke($container)
    {
        return new DefaultResultParser();
    }
}
