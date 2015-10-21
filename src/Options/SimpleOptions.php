<?php

namespace JervDesign\InputFilter\Options;

/**
 * Class SimpleOptions
 */
class SimpleOptions extends ArrayOptions
{
    protected $dataSetProcessorName = 'JervDesign\InputFilter\Processor\DataSetProcessor';

    protected $processorCollectionName = 'JervDesign\InputFilter\Processor\ProcessorCollection';

    protected $reservedProperties
        = [
            '_messages' => 'messages',
        ];
    protected $buildMethods
        = [
            'messages' => 'buildMessageData',
            '_default' => 'buildProcessorCollectionData',
        ];

    /**
     * @var array
     */
    protected $simpleOptions = [];

    /**
     * setOptions
     *
     * @param array $optionsData
     *
     * @return void
     */
    public function setOptions(array $optionsData)
    {
        $this->simpleOptions = $optionsData;

        $this->options = $this->buildSimpleOptions($optionsData);
    }

    /**
     * buildSimpleOptions
     *
     * @param array $optionsData
     *
     * @return array
     */
    protected function buildSimpleOptions(array $optionsData)
    {
        $parsedOptionData = $this->buildDataSetData('root', []);

        foreach ($optionsData as $fieldPath => $processorData) {
            $this->buildArray(
                $fieldPath,
                $processorData,
                $parsedOptionData
            );
        }

        return $parsedOptionData;
    }

    /**
     * buildArray
     *
     * @param string $key
     * @param mixed  $value
     * @param array  $target
     *
     * @return array
     */
    protected function buildArray($key, $value, &$target = [])
    {
        $path = explode('.', $key);
        $root = &$target;

        while (count($path) > 1) {
            $branch = array_shift($path);
            $branch = $this->buildPropertyName($branch);
            if (!isset($root[$branch])) {
                $root[$branch] = $this->buildDataSetData($branch);
            }

            $root = &$root[$branch];
        }

        $branch = $this->buildPropertyName($path[0]);
        //if (!$this->isReserved($path[0])) {
        //    $root['dataSet'][$branch] = $this->buildData($branch, $value);
        //} else {
            $root[$branch] = $this->buildData($branch, $value);
        //}

        return $target;
    }

    /**
     * buildData
     *
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    protected function buildData($name, $value)
    {
        $method = $this->buildMethods['_default'];

        if (array_key_exists($name, $this->buildMethods)) {
            $method = $this->buildMethods[$name];
        }

        return $this->$method($name, $value);
    }

    /**
     * buildDataSetData
     *
     * @param string $name
     *
     * @return array
     */
    protected function buildDataSetData($name, $value = [])
    {
        $config = [
            'name' => $name,
            'processor' => $this->dataSetProcessorName,
            'dataSet' => $value,
        ];

        return $config;
    }

    /**
     * buildProcessorCollectionData
     *
     * @param $name
     * @param $value
     *
     * @return array
     */
    protected function buildProcessorCollectionData($name, $value)
    {
        $config = [
            'name' => $name,
            'processor' => $this->processorCollectionName,
            'processors' => $value,
        ];

        return $config;
    }

    /**
     * buildMessageData
     *
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    protected function buildMessageData($name, $value)
    {
        $config = $value;

        return $config;
    }

    /**
     * buildPropertyName
     *
     * @param string $name
     *
     * @return string
     */
    protected function buildPropertyName($name)
    {
        if (array_key_exists($name, $this->reservedProperties)) {
            return $this->reservedProperties[$name];
        }

        return $name;
    }

    /**
     * isReserved
     *
     * @param $name
     *
     * @return bool
     */
    protected function isReserved($name)
    {
        return (array_key_exists($name, $this->reservedProperties));
    }
}
