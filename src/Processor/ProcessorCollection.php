<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class ProcessorCollection Composite Processor
 */
class ProcessorCollection extends AbstractProcessor
{
    /**
     * DEFAULT_CODE
     */
    const DEFAULT_CODE = 'processorsInvalid';

    /**
     * DEFAULT_CODE
     */
    const DEFAULT_MESSAGE = 'Data is invalid';

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
        $name = $this->getOption('name', $options, 'default');
        $processors = $this->getOption('processors', $options, []);

        $results = new ProcessorResult($name, true);

        foreach ($processors as $processorOptions) {
            $processorServiceName = $this->getOption('processor', $processorOptions, null);
            /** @var Processor $processor */
            $processor = $this->getProcessor($processorServiceName);

            // over-ride name
            $processorOptions['name'] = $name;

            $result = $processor->process($data, $processorOptions);

            $data = $result->getValue();

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
