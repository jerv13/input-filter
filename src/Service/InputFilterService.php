<?php

namespace Jerv\Validation\Service;

use Jerv\Validation\Exception\ServiceException;
use Jerv\Validation\Options\ArrayOptions;
use Jerv\Validation\Options\Keys;
use Jerv\Validation\Options\Options;
use Jerv\Validation\Processor\FieldSetProcessor;
use Jerv\Validation\Processor\Processor;
use Jerv\Validation\Result\Result;
use Jerv\Validation\ResultParser\DefaultResultParser;
use Jerv\Validation\ServiceLocator;

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
     * @param mixed $data
     * @param array $optionsArray
     *
     * @return Result
     */
    public function process(
        $data,
        array $optionsArray
    ) {
        $options = $this->buildOptions($optionsArray);

        $serviceName = $options->get(
            Keys::PROCESSOR,
            FieldSetProcessor::class
        );



        $service = $this->getService($serviceName);

        $result = $service->process($data, $options);

        $resultParserService = $options->get(
            Keys::RESULT_PARSER_CLASS,
            DefaultResultParser::class
        );

        return $this->parseResult($result, $options, $resultParserService);
    }

    /**
     * buildOptions
     *
     * @param array $optionsArray
     *
     * @return Options
     * @throws ServiceException
     */
    public function buildOptions(
        array $optionsArray
    ) {
        $optionClass = ArrayOptions::class;
        if (array_key_exists(Keys::OPTIONS_CLASS, $optionsArray)) {
            $optionClass = $optionsArray[Keys::OPTIONS_CLASS];
        }

        if (!class_exists($optionClass)) {
            throw new ServiceException('Class does not exist: ' . $optionClass);
        }

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
