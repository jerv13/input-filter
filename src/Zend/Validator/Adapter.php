<?php

namespace JervDesign\InputFilter\Zend\Validator;

use JervDesign\InputFilter\Processor\AbstractProcessor;
use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\Result\Result;

/**
 * Class Adapter
 */
class Adapter extends AbstractProcessor
{
    /**
     * process Validator and/or Validate
     *
     * @param mixed $data
     * @param array $options
     *
     * @return Result
     */
    public function process($data, array $options = [])
    {
        $name = $this->getOption('name', $options, 'default');
        $validatorClass = $this->getOption('zendValidator', $options);
        $validatorOptions = $this->getOption('zendValidatorOptions', $options, []);
        $context = $this->getOption('context', $options, []);

        /** @var \Zend\Validator\AbstractValidator $validator */
        $validator = new $validatorClass($validatorOptions);

        $isValid = $validator->isValid($data, $context);

        $messages = $validator->getMessages();

        $results = new ProcessorResult($name, true);

        if (!$isValid) {
            $results->setError('invalid', $options, 'Validation Failed');
        }

        foreach ($messages as $code => $message) {
            $result = new ProcessorResult($name);
            $result->setError($code, $options, $message);
            $results->addChild($result);
        }

        return $results;
    }
}
