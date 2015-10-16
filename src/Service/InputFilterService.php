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
     * @param mixed $data
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
     * processOptions
     *
     * @param mixed  $data
     * @param array  $optionsArray
     * @param string $optionClass
     *
     * @return Result
     */
    public function processOptionsArray(
        $data,
        array $optionsArray,
        $optionClass = '\JervDesign\InputFilter\Options\ArrayOptions'
    ) {
        /** @var Options $options */
        $options = new $optionClass();
        $options->setOptions($optionsArray);

        return $this->process($data, $options);
    }
}
