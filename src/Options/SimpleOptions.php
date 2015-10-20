<?php

namespace JervDesign\InputFilter\Options;

/**
 * Class SimpleOptions
 */
class SimpleOptions extends ArrayOptions
{
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
            $fieldPathData = explode('.', $fieldPath);
        }

        return $parsedOptionData;
    }

    protected function buildFieldProcessors($fieldPathData, $processorData)
    {
        $i = 0;
        $cnt = count($fieldPathData);

        foreach ($fieldPathData as $fieldName) {
            $i++;

            if ($i < $cnt) {
                $this->buildDataSet($fieldName);
                continue;
            }

        }
    }

    protected function buildDataSet($fieldPathData)
    {

        $i = 0;
        $cnt = count($fieldPathData);

        foreach ($fieldPathData as $fieldName) {
            $i++;

            if ($i < $cnt) {
                $this->buildDataSet($fieldName);
                continue;
            }

        }
    }

    protected function buildMessages()
    {

    }
}
