<?php

namespace Jerv\Validation\Options;

use Jerv\Validation\Exception\OptionsException;
use Jerv\Validation\Processor\FlatFieldSetProcessor;
use Jerv\Validation\Processor\ProcessorCollection;
use Jerv\Validation\ResultParser\FlatMessagesResultParser;

/**
 * Class FlatOptions
 */
class FlatOptions extends ArrayOptions
{
    protected $fieldSetProcessorName = FlatFieldSetProcessor::class;

    protected $resultParserClass = FlatMessagesResultParser::class;

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
     * buildFlatOptions
     *
     * @param array $optionsData
     *
     * @return array
     * @throws OptionsException
     */
    protected function buildFlatOptions(array $optionsData)
    {
        $optionsPre = new ArrayOptions();
        $optionsPre->setOptions($optionsData);

        $options = [
            Keys::NAME => $optionsPre->get(Keys::NAME, 'field-set'),
            Keys::FIELD_SET => [],
            Keys::MESSAGES => $optionsPre->get(Keys::MESSAGES, []),
        ];

        $options[Keys::PROCESSOR] = $optionsPre->get(
            Keys::PROCESSOR,
            $this->fieldSetProcessorName
        );

        $options[Keys::RESULT_PARSER_CLASS] = $optionsPre->get(
            Keys::RESULT_PARSER_CLASS,
            $this->resultParserClass
        );

        $fieldSetPre = $optionsPre->get(
            Keys::FIELD_SET,
            []
        );

        foreach ($fieldSetPre as $fieldPath => $processorData) {

            if ($this->isMessagesPath($fieldPath)) {
                continue;
            }

            $options[Keys::FIELD_SET][$fieldPath] = [
                Keys::NAME => $fieldPath,
                Keys::PROCESSOR => $this->processorCollectionName,
                Keys::PROCESSORS => $processorData,
                Keys::MESSAGES => $this->getFieldMessages($fieldPath, $optionsData),
            ];
        }

        $optionsFieldSet = [];

        foreach ($options[Keys::FIELD_SET] as $fieldPath => $processorData) {
            if (!$this->isMessagesPath($fieldPath)) {
                $optionsFieldSet[$fieldPath] = $processorData;
            }
        }

        $options[Keys::FIELD_SET] = $optionsFieldSet;

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
