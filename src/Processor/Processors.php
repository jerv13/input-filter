<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Result\ProcessorResult;

/**
 * Class Processors Composite Processor
 */
class Processors extends AbstractProcessor
{
    /**
     * array [Processor]
     */
    protected $processors = [];

    /**
     * add
     *
     * @param Processor $processor
     *
     * @return void
     */
    public function add(Processor $processor)
    {
        $this->processors[] = $processor;
    }

    /**
     * process
     *
     * @param mixed $data
     * @param array $options
     *
     * @return ProcessorResult
     */
    public function process($data, $options = [])
    {
        $results = new ProcessorResult();
        $results->setValid(true);

        $name = $this->getOption('name', $options, 'default');

        /** @var Processor $processor */
        foreach ($this->processors as $processor) {
            $result = $processor->process($data, $options);
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
