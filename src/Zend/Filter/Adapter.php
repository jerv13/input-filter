<?php

namespace JervDesign\InputFilter\Zend\Filter;

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
     * process Filter and/or Validate
     *
     * @param mixed $data
     * @param Options $options
     *
     * @return Result
     */
    public function process($data, Options $options, ResultCollection $results = null)
    {
        $name = $options->get('name', 'default');
        $filterClass = $options->get('zendFilter');
        $filterOptions = $options->get('zendFilterOptions', []);

        /** @var \Zend\Filter\AbstractFilter $filter */
        $filter = new $filterClass();

        $filter->setOptions($filterOptions);

        $filteredData = $filter->filter($data);

        $result = new ProcessorResultCollection($name, $this, true);
        $result->setSuccess($filteredData);
        return $result;
    }
}
