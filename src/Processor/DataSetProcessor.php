<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\Result\ProcessorResultCollection;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\Result\ResultCollection;
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
    public function process($data, Options $options, ResultCollection $results = null)
    {
        $name = $options->get('name', 'default');
        $fieldOptions = $options->getOptions('dataSet');
        $context = $data;

        $results = new ProcessorResultCollection($name, $this, true);

        /** @var Processor $processor */
        foreach ($data as $fieldName => $value) {
            $fieldOption = $fieldOptions->getOptions($fieldName);

            $fieldOption->set('context', $context);

            $processorName = $fieldOption->get('processor', null);

            if ($processorName === null) {
                throw new \Exception('Processor not found in options');
            }

            $processor = $this->getProcessor($processorName);

            $result = $processor->process($value, $fieldOption, $results);
            $data[$fieldName] = $result->getValue();
            $result->setName($fieldName);

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
