<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Message\MessageParser;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class AbstractProcessor
 */
abstract class AbstractProcessor implements Processor
{
    /**
     * @var
     */
    protected $serviceLocator;

    /**
     * @param ServiceLocator $serviceLocator
     */
    public function __construct(ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * getProcessor
     *
     * @param $serviceName
     *
     * @return mixed
     */
    public function getProcessor($serviceName)
    {
        return $this->serviceLocator->get($serviceName);
    }
}
