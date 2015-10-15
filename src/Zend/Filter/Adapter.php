<?php

namespace JervDesign\InputFilter\Zend\Filter;

use JervDesign\InputFilter\Processor\AbstractProcessor;
use JervDesign\InputFilter\Result\ProcessorResult;
use JervDesign\InputFilter\Result\Result;

/**
 * Class Adapter
 */
class Adapter extends AbstractProcessor
{
    /**
     * process Filter and/or Validate
     *
     * @param mixed $data
     * @param array $options
     *
     * @return Result
     */
    public function process($data, array $options = [])
    {
        $name = $this->getOption('name', $options, 'default');
        $filterClass = $this->getOption('zendFilter', $options);
        $filterOptions = $this->getOption('zendFilterOptions', $options, []);

        /** @var \Zend\Filter\AbstractFilter $filter */
        $filter = new $filterClass();

        $filter->setOptions($filterOptions);

        $filteredData = $filter->filter($data);

        $result = new ProcessorResult($name);
        $result->setSuccess($filteredData);
        return $result;
    }
}
