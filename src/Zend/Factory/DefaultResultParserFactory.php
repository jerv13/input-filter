<?php

namespace Jerv\Validation\Zend\Factory;

use Jerv\Validation\ResultParser\DefaultResultParser;
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
    public function __($container)
    {
        return new DefaultResultParser();
    }
}
