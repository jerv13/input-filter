<?php

namespace JervDesign\InputFilter\Service;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Processor\AbstractProcessor;
use JervDesign\InputFilter\Processor\Processor;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class InputFilterService
 */
class InputFilterService extends AbstractProcessor
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
     * @param $id
     *
     * @return Processor
     */
    protected function getService($id)
    {
        return $this->serviceLocator->get($id);
    }

    /**
     * process Filter and/or Validate
     *
     * @param mixed   $data
     * @param Options $options
     *
     * @return Result
     */
    public function process($data, Options $options)
    {
        $serviceName = $options->get(
            'processor',
            'JervDesign\InputFilter\DataSetProcessor'
        );

        $service = $this->getService($serviceName);

        return $service->process($data, $options);
    }

    /**
     * processData
     *
     * @param        $data
     * @param array  $optionsArray
     * @param string $optionClass
     * @param string $resultParserClass
     *
     * @return Result
     */
    public function processData(
        $data,
        array $optionsArray,
        $optionClass = '\JervDesign\InputFilter\Options\ArrayOptions',
        $resultParserService = 'JervDesign\InputFilter\Message\DefaultResultParser'
    ) {
        /** @var Options $options */
        $options = new $optionClass();
        $options->setOptions($optionsArray);

        $result = $this->process($data, $options);

        return $result;
    }

    /**
     * getResultArray
     *
     * @param Result  $result
     * @param Options $options
     * @param string  $resultParserService
     *
     * @return mixed
     */
    public function getResultArray(
        Result $result,
        Options $options,
        $resultParserService = 'JervDesign\InputFilter\Message\DefaultResultParser'
    ) {
        $parcerService = $this->getService($resultParserService);

        return $parcerService->parce($result, $options);
    }
}
