<?php

namespace Jerv\Validation\ResultParser;

use Psr\Container\ContainerInterface;

/**
 * Class FlatMessagesResultParserFactory
 */
class FlatMessagesResultParserFactory
{
    /**
     * createService
     *
     * @param ContainerInterface $container
     *
     * @return FlatMessagesResultParser
     */
    public function __invoke($container)
    {
        return new FlatMessagesResultParser();
    }
}
