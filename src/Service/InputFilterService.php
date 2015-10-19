<?php

namespace JervDesign\InputFilter\Service;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Processor\Processor;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\ServiceLocator;

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
        return $this->serviceLocator->get($serviceName);
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
        $optionClass = '\JervDesign\InputFilter\Options\ArrayOptions'
    ) {
        $options = $this->buildOptions($optionsArray, $optionClass);

        $serviceName = $options->get(
            'processor',
            'JervDesign\InputFilter\DataSetProcessor'
        );

        $service = $this->getService($serviceName);

        $result = $service->process($data, $options);

        $resultParserService = $options->get(
            'resultParser',
            'JervDesign\InputFilter\ResultParser\DefaultResultParser'
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
        $optionClass = '\JervDesign\InputFilter\Options\ArrayOptions'
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
        $resultParserService = 'JervDesign\InputFilter\ResultParser\DefaultResultParser'
    ) {
        /** @var \JervDesign\InputFilter\ResultParser\ResultParser $parserService */
        $parserService = $this->getService($resultParserService);

        return $parserService->parse($result, $options);
    }
}
