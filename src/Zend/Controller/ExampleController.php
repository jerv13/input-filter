<?php

namespace JervDesign\InputFilter\Zend\Controller;

use JervDesign\InputFilter\Options\SimpleOptions;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

/**
 * Class ExampleController
 */
class ExampleController extends AbstractRestfulController
{
    /**
     * @var string
     */
    protected $defaultExample = 'ZendDataSetProcessor';
    /**
     * @var array
     */
    protected $exampleConfig = [];

    /**
     * get
     *
     * @param mixed $id
     *
     * @return JsonModel
     */
    public function get($id)
    {
        $data = ['example' => 'SimpleConfigFormat'];
        $config = $this->getExampleConfig($data);
        //var_export($config);
        $options = new SimpleOptions($config);
        print_r($options->toArray());
die;
        //////
        $data = [];
        $data['example'] = $this->defaultExample;
        $data['data'] = [
            'myField' => "Some<p>value</p><br>",
            'yourField' => "<p><br></p>",
        ];

        return new JsonModel($data);
    }

    /**
     * get
     *
     * @param mixed $data
     *
     * @return JsonModel
     */
    public function create($data)
    {
        $zendServiceLocator = $this->getServiceLocator();
        /** @var \JervDesign\InputFilter\Service\InputFilterService $inputFilterService */
        $inputFilterService = $zendServiceLocator->get(
            'JervDesign\InputFilter\Service\InputFilterService'
        );

        $exampleConfig = $this->getExampleConfig($data);

        if (!$data['data']) {
            $data['data'] = [];
        }

        $fields = $data['data'];

        $result = $inputFilterService->process($fields, $exampleConfig);

        $return = $result->toArray();

        return new JsonModel($return);
    }

    /**
     * getExampleConfig
     *
     * @param $data
     *
     * @return mixed
     */
    protected function getExampleConfig($data)
    {
        if (empty($this->exampleConfig)) {
            $this->exampleConfig = include(__DIR__
                . '/../../../config/example.config.php');
        }
        if (!$data['example']) {
            return $this->getExample($this->defaultExample);
        }

        return $this->getExample($data['example']);
    }

    /**
     * getExample
     *
     * @param $key
     *
     * @return mixed
     */
    protected function getExample($key)
    {
        if (!$this->exampleConfig[$key]) {
            return $this->exampleConfig[$this->defaultExample];
        }

        return $this->exampleConfig[$key];
    }
}
