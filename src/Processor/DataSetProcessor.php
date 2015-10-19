<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Options\Options;
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
     * @param mixed   $data
     * @param Options $options
     *
     * @return ProcessorResult
     * @throws \Exception
     */
    public function process($data, Options $options)
    {
        $name = $options->get('name', 'default');
        $fieldOptions = $options->getOptions('dataSet');
        $context = $data;

        $results = new ProcessorResult($name, $data, $this, true);

        /** @var Processor $processor */
        foreach ($data as $fieldName => $value) {
            $fieldOption = $fieldOptions->getOptions($fieldName);

            $fieldOption->set('context', $context);
            $fieldOption->set('name', $fieldName);

            $processorName = $fieldOption->get('processor', null);

            if ($processorName === null) {
                throw new \Exception('Processor not found in options');
            }

            $processor = $this->getProcessor($processorName);

            $result = $processor->process($value, $fieldOption);
            $data[$fieldName] = $result->getValue();

            if (!$result->isValid()) {
                $results->setError(
                    self::DEFAULT_CODE,
                    $options,
                    self::DEFAULT_MESSAGE
                );
                $results->addResult($result);
            }
        }

        $results->setValue($data);

        return $results;
    }
}
