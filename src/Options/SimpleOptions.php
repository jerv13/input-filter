<?php

namespace Jerv\Validation\Options;

use Jerv\Validation\Processor\DataSetProcessor;
use Jerv\Validation\Processor\ProcessorCollection;

/**
 * Class SimpleOptions
 */
class SimpleOptions extends ArrayOptions
{
    protected $dataSetProcessorName = DataSetProcessor::class;

    protected $processorCollectionName = ProcessorCollection::class;

    protected $reservedProperties
        = [
            '_messages' => 'messages',
            '_dataSet' => 'dataSet',
            '_field' => 'field',
        ];
    protected $buildMethods
        = [
            'messages' => 'buildMessageData',
            'dataSet' => 'buildDataSetData',
            'field' => 'buildProcessorCollectionData',
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
        $parsedOptionData = [];

        foreach ($optionsData as $fieldPath => $processorData) {
            $this->buildArray(
                $fieldPath,
                $processorData,
                $parsedOptionData
            );
        }

        var_dump($parsedOptionData);die;

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
        $path = $this->buildNormalPathArray($key);
        $root = &$target;
        $parentBranch = '';

        while (count($path) > 0) {
            $name = array_shift($path);
            $branch = $this->buildPropertyName($name);

            if (!isset($root[$branch])) {
                if ($this->isReserved($name)) {
                    $parent = $this->buildData($branch, $value);
                    $root = array_merge($parent, $root);
                } else {
                    //if ($parentBranch == 'dataSet')
                    //$root[$branch] = $this->buildDataSetData($branch, $value);

                    //} else {
                    $root[$branch] = $this->buildData($branch, $value);
                }
            }

            $parentBranch = $branch;
            $root = &$root[$branch];
        }

        //$root[$branch] = $this->buildData($branch, $value);

        return $target;
    }

    protected function buildNormalPathArray($key)
    {
        $path = explode('.', $key);

        $normalPath = [];
        $pathCnt = count($path);
        $pathCntIndex = $pathCnt - 1;

        foreach ($path as $index => $name) {
            if (!$this->isReserved($name)) {
                $normalPath[] = '_dataSet';
            }
            $normalPath[] = $name;
            if ($pathCntIndex == $index && !$this->isReserved($name)) {
                $normalPath[] = '_field';
            }
        }

        var_export(implode('.', $normalPath));

        return $normalPath;
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
        $method = $this->buildMethods['field'];

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
