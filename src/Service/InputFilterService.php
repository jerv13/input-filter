<?php

namespace JervDesign\InputFilter\Service;

use JervDesign\InputFilter\Processor\AbstractProcessor;
use JervDesign\InputFilter\Processor\Processor;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class InputFilterService
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class InputFilterService extends AbstractProcessor
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
     * getService
     *
     * @param $id
     *
     * @return Processor
     */
    protected function getService($id)
    {
        return $this->serviceLocator->get($id);
    }

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
        $serviceName = $this->getOption('processor', $options, 'JervDesign\InputFilter\DataSetProcessor');

        $service = $this->getService($serviceName);

        return $service->process($data, $options);
    }
}
