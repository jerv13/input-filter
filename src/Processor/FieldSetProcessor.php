<?php

namespace JervDesign\InputFilter\Processor;

use JervDesign\InputFilter\Result\ProcessorResult;

/**
 * Class FieldSetProcessor
 */
class FieldSetProcessor extends DiProcessor
{
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
        $fieldOptions = $this->getOption('fieldSet', $options, []);

        /** @var Processor $processor */
        foreach ($data as $fieldName => $value) {
            $fieldOption =  $this->getOption($fieldName, $fieldOptions, []);
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
