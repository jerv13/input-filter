<?php

namespace Jerv\Validation\Zend\Filter;

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
     * process Filter and/or Validate
     *
     * @param mixed $data
     * @param Options $options
     *
     * @return Result
     */
    public function process($data, Options $options)
    {
        $name = $options->get('name', 'default');
        $filterClass = $options->get('zendFilter');
        $filterOptions = $options->get('zendFilterOptions', []);

        /** @var \Zend\Filter\AbstractFilter $filter */
        $filter = new $filterClass();

        $filter->setOptions($filterOptions);

        $filteredData = $filter->filter($data);

        $result = new ProcessorResult($name, $data, $this, true);
        $result->setSuccess($filteredData);
        return $result;
    }
}
