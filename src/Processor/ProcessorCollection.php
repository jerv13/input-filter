<?php

namespace Jerv\Validation\Processor;

use Jerv\Validation\Exception\ProcessorException;
use Jerv\Validation\Options\Keys;
use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\ProcessorResult;
use Jerv\Validation\ServiceLocator;

/**
 * Class ProcessorCollection Composite Processor
 */
class ProcessorCollection extends AbstractProcessor implements Processor
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
     * @param mixed   $data
     * @param Options $options
     *
     * @return ProcessorResult
     * @throws \Exception
     */
    public function process(
        $data,
        Options $options
    ) {
        $name = $options->get(Keys::NAME, 'default');
        $processors = $options->get(Keys::PROCESSORS, []);

        if (empty($processors)) {
            throw new ProcessorException('Processors not found in options');
        }

        $results = new ProcessorResult($name, $data, $this, true);

        foreach ($processors as $key => $processorOptionsArray) {
            $processorOptions = $options->createOptions($processorOptionsArray);

            $processorServiceName = $processorOptions->get(
                Keys::PROCESSOR,
                null
            );

            if ($processorServiceName === null) {
                throw new ProcessorException('Processor not found in options');
            }

            /** @var Processor $processor */
            $processor = $this->getProcessor($processorServiceName);

            // over-ride name
            $processorOptions->set(Keys::NAME, $name);

            $result = $processor->process($data, $processorOptions);

            $data = $result->getValue();

            if (!$result->isValid()) {
                $results->setValid(false);
                foreach ($result->getMessages() as $code => $message) {
                    $results->setMessage($code, $message);
                }
            }
        }

        $results->setValue($data);

        return $results;
    }
}
