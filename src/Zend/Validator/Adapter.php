<?php

namespace Jerv\Validation\Zend\Validator;

use Jerv\Validation\Options\Options;
use Jerv\Validation\Processor\AbstractProcessor;
use Jerv\Validation\Result\ProcessorResult;
use Jerv\Validation\Result\Result;

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

        $result = new ProcessorResult($name, $data, $this, true);
        $result->setSuccess($data);

        foreach ($messages as $code => $message) {
            $result->setError($code, $options, $message);
        }

        return $result;
    }
}
