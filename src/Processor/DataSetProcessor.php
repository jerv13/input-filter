<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class DataSetProcessor
 */
class DataSetProcessor extends AbstractProcessor
{
    /**
     * DEFAULT_CODE
     */
    const DEFAULT_CODE = 'dataSetInvalid';

    /**
     * DEFAULT_CODE
     */
    const DEFAULT_MESSAGE = 'Data set is invalid';

    /**
     * @var ServiceLocator
     */
    protected $serviceLocator;

    /**
     * @param ServiceLocator $serviceLocator
     */
    public function __construct(
        ServiceLocator $serviceLocator
    ) {
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

    /**
     * process
     *
     * @param mixed $data
     * @param array $options
     *
     * @return ProcessorResult
     */
    public function process($data, array $options = [])
    {
        $name = $this->getOption('name', $options, 'default');
        $fieldOptions = $this->getOption('dataSet', $options, []);
        $context = $data;

        $results = new ProcessorResult($name, true);

        /** @var Processor $processor */
        foreach ($data as $fieldName => $value) {
            $fieldOption = $this->getOption($fieldName, $fieldOptions, []);

            $fieldOption['context'] = $context;

            $processorServiceName = $this->getOption(
                'processor',
                $fieldOption,
                null
            );

            $processor = $this->getProcessor($fieldOption['processor']);

            $result = $processor->process($value, $fieldOption);
            $data[$fieldName] = $result->getValue();
            $result->setName($name);

            if (!$result->isValid()) {
                $results->setError(
                    self::DEFAULT_CODE,
                    $options,
                    self::DEFAULT_MESSAGE
                );
                $results->addChild($result);
            }
        }

        $results->setValue($data);

        return $results;
    }
}
