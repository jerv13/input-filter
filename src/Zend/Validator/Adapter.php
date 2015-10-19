<?php

namespace JervDesign\InputFilter\Zend\Validator;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Processor\AbstractProcessor;
use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\Result\ProcessorResultCollection;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\Result\ResultCollection;

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
    public function process($data, Options $options, ResultCollection $results = null)
    {
        $name = $options->get('name', 'default');
        $validatorClass = $options->get('zendValidator');
        $validatorOptions = $options->get('zendValidatorOptions', []);
        $context = $options->get('context', []);

        /** @var \Zend\Validator\AbstractValidator $validator */
        $validator = new $validatorClass($validatorOptions);

        $isValid = $validator->isValid($data, $context);

        $messages = $validator->getMessages();

        $results = new ProcessorResultCollection($name, $this, true);
        $results->setSuccess($data);

        if (!$isValid) {
            $results->setError('invalid', $options, 'Validation Failed');
        }

        foreach ($messages as $code => $message) {
            $result = new ProcessorResult($name, $this);
            $result->setError($code, $options, $message);
            $results->addChild($result);
        }

        return $results;
    }
}
