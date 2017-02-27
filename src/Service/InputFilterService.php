<?php

namespace Jerv\Validation\Service;

use Jerv\Validation\Options\Options;
use Jerv\Validation\Processor\Processor;
use Jerv\Validation\Result\Result;
use Jerv\Validation\ServiceLocator;
use Jerv\Validation\Options\ArrayOptions;
use Jerv\Validation\Processor\DataSetProcessor;
use Jerv\Validation\ResultParser\DefaultResultParser;

/**
 * Class InputFilterService
 */
class InputFilterService
{
    /**
     * @var ServiceLocator
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
     * getService
     *
     * @param string $serviceName
     *
     * @return Processor
     */
    protected function getService($serviceName)
    {
        /** @var Processor $processor */
        $processor = $this->serviceLocator->get($serviceName);

        return $processor;
    }

    /**
     * process Data
     *
     * @param mixed  $data
     * @param array  $optionsArray
     * @param string $optionClass
     *
     * @return Result
     */
    public function process(
        $data,
        array $optionsArray,
        $optionClass = ArrayOptions::class
    ) {
        $options = $this->buildOptions($optionsArray, $optionClass);

        $serviceName = $options->get(
            'processor',
            DataSetProcessor::class
        );

        $service = $this->getService($serviceName);

        $result = $service->process($data, $options);

        $resultParserService = $options->get(
            'resultParser',
            DefaultResultParser::class
        );

        return $this->parseResult($result, $options, $resultParserService);
    }

    /**
     * buildOptions
     *
     * @param array  $optionsArray
     * @param string $optionClass
     *
     * @return Options
     */
    public function buildOptions(
        array $optionsArray,
        $optionClass = '\Jerv\Validation\Options\ArrayOptions'
    ) {
        /** @var Options $options */
        $options = new $optionClass();
        $options->setOptions($optionsArray);
        return $options;
    }

    /**
     * getResultArray
     *
     * @param Result  $result
     * @param Options $options
     * @param string  $resultParserService
     *
     * @return Result
     */
    public function parseResult(
        Result $result,
        Options $options,
        $resultParserService = DefaultResultParser::class
    ) {
        /** @var \Jerv\Validation\ResultParser\ResultParser $parserService */
        $parserService = $this->getService($resultParserService);

        return $parserService->parse($result, $options);
    }
}
