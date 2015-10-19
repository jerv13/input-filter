<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\Result\ProcessorResultCollection;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class ProcessorCollection Composite Processor
 */
class ProcessorCollection extends AbstractProcessor
{
    /**
     * DEFAULT_CODE
     */
    const DEFAULT_CODE = 'validationFailedForOneOrMoreProcessors';

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
     * @param Options $options
     *
     * @return ProcessorResult
     * @throws \Exception
     */
    public function process(
        $data,
        Options $options
    ) {
        $name = $options->get('name', 'default');
        $processors = $options->get('processors', []);

        if (empty($processors)) {
            throw new \Exception('Processors not found in options');
        }

        $results = new ProcessorResult($name, $this, true);

        foreach ($processors as $key => $processorOptionsArray) {
            $processorOptions = $options->createOptions($processorOptionsArray);

            $processorServiceName = $processorOptions->get(
                'processor',
                null
            );

            if ($processorServiceName === null) {
                throw new \Exception('Processor not found in options');
            }

            /** @var Processor $processor */
            $processor = $this->getProcessor($processorServiceName);

            // over-ride name
            $processorOptions->set('name', $name);

            $result = $processor->process($data, $processorOptions, $results);

            $data = $result->getValue();

            if (!$result->isValid()) {
                $results->setError(
                    self::DEFAULT_CODE,
                    $options,
                    self::DEFAULT_MESSAGE
                );
                foreach($result->getMessages() as $code => $message) {
                    $results->setMessage($code, $message);
                }
                //$results->addChild($result);
            }
        }

        $results->setValue($data);

        return $results;
    }
}
