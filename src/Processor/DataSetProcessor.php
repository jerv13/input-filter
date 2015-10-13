<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Message\MessageParser;
use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class DataSetProcessor
 */
class DataSetProcessor extends AbstractProcessor
{
    /**
     * @var ServiceLocator
     */
    protected $serviceLocator;

    /**
     * @param ServiceLocator     $serviceLocator
     * @param MessageParser|null $messageParser
     */
    public function __construct(
        ServiceLocator $serviceLocator,
        $messageParser = null
    ) {
        $this->serviceLocator = $serviceLocator;
        parent::__construct($messageParser);
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
        $results = new ProcessorResult();
        $results->setValid(true);

        $name = $this->getOption('name', $options, 'default');
        $fieldOptions = $this->getOption('dataSet', $options, []);

        /** @var Processor $processor */
        foreach ($data as $fieldName => $value) {
            $fieldOption = $this->getOption($fieldName, $fieldOptions, []);

            $processor = $this->getProcessor($fieldOption['processor']);

            $result = $processor->process($value, $fieldOption);
            $data[$fieldName] = $result->getValue();
            $result->setName($name);

            if (!$result->isValid()) {
                $results->setValid(false);
                $results->addChild($result);
            }
        }

        $results->setValue($data);

        if (!$results->isValid()) {
            $results->setMessage(
                "Some values for {$name} are invalid"
            );
        }

        return $results;
    }
}
