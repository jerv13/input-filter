<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class Processors Composite Processor
 */
class Processors extends AbstractProcessor
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

        $processors = $this->getOption('processors', $options, []);

        foreach ($processors as $processorOptions) {
            $processorServiceName = $this->getOption('processor', $processorOptions, null);
            /** @var Processor $processor */
            $processor = $this->getProcessor($processorServiceName);

            // over-ride name
            $processorOptions['name'] = $name;

            $result = $processor->process($data, $processorOptions);

            $data = $result->getValue();

            if (!$result->isValid()) {
                $results->setValid(false);
                $results->addChild($result);
            }
        }

        $results->setValue($data);
        $results->setName($name);

        if (!$results->isValid()) {
            $results->setMessage(
                "Processor {$name} failed validation"
            );
        }

        return $results;
    }
}
