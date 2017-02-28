<?php

namespace Jerv\Validation\Options;

use Jerv\Validation\Processor\DataSetFlatProcessor;
use Jerv\Validation\Processor\ProcessorCollection;

/**
 * Class FlatOptions
 */
class FlatOptions extends ArrayOptions
{
    protected $dataSetProcessorName = DataSetFlatProcessor::class;

    protected $processorCollectionName = ProcessorCollection::class;

    /**
     * @var array
     */
    protected $flatOptions = [];

    /**
     * setOptions
     *
     * @param array $optionsData
     *
     * @return void
     */
    public function setOptions(array $optionsData)
    {
        $this->flatOptions = $optionsData;

        $this->options = $this->buildFlatOptions($optionsData);
    }

    /**
     * buildFlatOptionsTest
     *
     * @param array $optionsData
     *
     * @return array
     */
    protected function buildFlatOptions(array $optionsData)
    {
        $options = [
            Keys::NAME => 'field-set',
            Keys::PROCESSOR => $this->dataSetProcessorName,
            Keys::DATA_SET => [],
            Keys::MESSAGES => $this->getMessages($optionsData)
        ];

        foreach ($optionsData as $fieldPath => $processorData) {

            if ($this->isMessagesPath($fieldPath)) {
                continue;
            }

            $options[Keys::DATA_SET][$fieldPath] = [
                Keys::NAME => $fieldPath,
                Keys::PROCESSOR => $this->processorCollectionName,
                Keys::PROCESSORS => $processorData,
                Keys::MESSAGES => $this->getFieldMessages($fieldPath, $optionsData),
            ];
        }

        $optionsDataSet = [];

        foreach ($options[Keys::DATA_SET] as $fieldPath => $processorData) {
            if (!$this->isMessagesPath($fieldPath)) {
                $optionsDataSet[$fieldPath] = $processorData;
            }
        }

        $options[Keys::DATA_SET] = $optionsDataSet;

        return $options;
    }

    /**
     * getFieldMessages
     *
     * @param string $fieldPath
     * @param array  $optionsData
     *
     * @return array
     */
    protected function getFieldMessages($fieldPath, array $optionsData)
    {
        $messagesFieldPath = $fieldPath . '.' . Keys::MESSAGES_RESERVED;

        if (array_key_exists($messagesFieldPath, $optionsData)) {
            return $optionsData[$messagesFieldPath];
        }

        return [];
    }

    /**
     * getMessages
     *
     * @param $optionsData
     *
     * @return array
     */
    protected function getMessages(array $optionsData)
    {
        if (array_key_exists(Keys::MESSAGES_RESERVED, $optionsData)) {
            return $optionsData[Keys::MESSAGES_RESERVED];
        }

        return [];
    }

    /**
     * isMessagePath
     *
     * @param string $fieldPath
     *
     * @return bool
     */
    protected function isMessagesPath($fieldPath)
    {
        $pos = strrpos($fieldPath, Keys::MESSAGES_RESERVED);

        return $pos !== false;
    }
}
