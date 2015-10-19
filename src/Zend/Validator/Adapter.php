<?php

namespace JervDesign\InputFilter\Zend\Validator;

use JervDesign\InputFilter\Options\Options;
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
     * @param mixed   $data
     * @param Options $options
     *
     * @return Result
     */
    public function process($data, Options $options)
    {
        $name = $options->get('name', 'default');
        $validatorClass = $options->get('zendValidator');
        $validatorOptions = $options->get('zendValidatorOptions', []);
        $context = $options->get('context', []);

        /** @var \Zend\Validator\AbstractValidator $validator */
        $validator = new $validatorClass($validatorOptions);

        $isValid = $validator->isValid($data, $context);

        $messages = $validator->getMessages();

        $result = new ProcessorResult($name, $this, true);
        $result->setSuccess($data);

        foreach ($messages as $code => $message) {
            $result->setError($code, $options, $message);
        }

        return $result;
    }
}
