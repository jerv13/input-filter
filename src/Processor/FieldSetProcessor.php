<?php

namespace Jerv\Validation\Processor;

use Jerv\Validation\Exception\ProcessorException;
use Jerv\Validation\Options\ArrayOptions;
use Jerv\Validation\Options\Keys;
use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\ProcessorResult;
use Jerv\Validation\ServiceLocator;

/**
 * Class FieldSetProcessor
 */
class FieldSetProcessor extends AbstractProcessor implements Processor
{
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
        $name = $options->get(Keys::NAME, 'default');
        $fieldSet = $options->get(Keys::FIELD_SET, []);
        $context = $data;

        $results = new ProcessorResult($name, $data, $this, true);

        $cleanData = [];

        /** @var Processor $processor */
        foreach ($fieldSet as $fieldName => $value) {

            $fieldOption = new ArrayOptions();
            $fieldOption->setOptions($value);

            $fieldOption->set(Keys::CONTEXT, $context);
            $fieldOption->set(Keys::NAME, $fieldName);

            $processorName = $fieldOption->get(Keys::PROCESSOR, null);

            if ($processorName === null) {
                throw new ProcessorException('Processor not found in options for ' . $fieldName);
            }

            $processor = $this->getProcessor($processorName);

            $dataValue = $this->getDataValue($fieldName, $data);

            $result = $processor->process($dataValue, $fieldOption);
            $cleanData[$fieldName] = $result->getValue();

            if (!$result->isValid()) {
                $results->setError(
                    Processor::DEFAULT_CODE,
                    $options,
                    Processor::DEFAULT_MESSAGE
                );
                $results->addResult($result);
            }
        }

        $results->setValue($cleanData);

        return $results;
    }

    /**
     * getDataValue
     *
     * @param string $fieldName
     * @param array  $data
     *
     * @return null
     */
    protected function getDataValue($fieldName, $data)
    {
        if ($this->hasDataField($fieldName, $data)) {
            return $data[$fieldName];
        }

        return null;
    }

    /**
     * hasDataField
     *
     * @param string $fieldName
     * @param array  $data
     *
     * @return bool
     */
    protected function hasDataField($fieldName, $data)
    {
        return array_key_exists($fieldName, $data);
    }
}
