<?php

namespace JervDesign\InputFilter\Zend\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

/**
 * Class ExampleController
 */
class ExampleController extends AbstractRestfulController
{
    /**
     * get
     *
     * @param mixed $id
     *
     * @return JsonModel
     */
    public function get($id)
    {
        $zendServiceLocator= $this->getServiceLocator();
        /** @var \JervDesign\InputFilter\Service\InputFilterService $inputFilterService */
        $inputFilterService = $zendServiceLocator->get(
            'JervDesign\InputFilter\Service\InputFilterService'
        );

        $exampleConfig = [
            'name' => 'fieldName',
            'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
            'zendFilter' => 'Zend\Filter\Boolean',
            'zendFilterOptions' => [
                // options to be passed to zend filter
                'type' => 'integer'
            ],
            // message over-ride
            'messages' => [
                '{code}' => '{messageValue}',
            ],
        ];

        $exampleConfig = [
            'name' => 'fieldName',
            'processor' => 'JervDesign\InputFilter\Zend\Validator\Adapter',
            'zendValidator' => 'Zend\Validator\StringLength',
            'zendValidatorOptions' => [
                // options to be passed to zend filter
                'min' => 2,
                'max' => 4,
            ],
            // message over-ride
            'messages' => [
                '{code}' => '{messageValue}',
            ],
        ];

        $result = $inputFilterService->process($id, $exampleConfig);

        $return = $result->toArray();

        return new JsonModel($return);
    }
}
