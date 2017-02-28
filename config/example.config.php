<?php
return [
    // message params?
    'messageParams' => [
        '{code}' => [
            '{paramName}' => '{paramValue}'
        ],
    ],
    /**
     * @example
     */
    '_FieldSetProcessor' => [
        'name' => 'setName',
        'processor' => Jerv\Validation\Processor\FieldSetProcessor::class,
        'field-set' => [
            'myField' => [
                'processor' => '{ProcessorService}',
                '{ProcessorServiceOptionKey}' => "{ProcessorServiceOptionValue}",
                // message over-ride
                'messages' => [
                    '{code}' => '{messageValue}',
                ],
            ]
        ],
        // message over-ride
        'messages' => [
            '{code}' => '{messageValue}',
        ],
    ],
    /**
     * @example
     */
    '_ProcessorCollection' => [
        'name' => 'fieldName',
        'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
        'processors' => [
            [
                'processor' => '{ProcessorService}',
                '{ProcessorServiceOptionKey}' => "{ProcessorServiceOptionValue}",
                // message over-ride
                'messages' => [
                    '{code}' => '{messageValue}',
                ],
            ]

        ],
        'messages' => [
            '{code}' => '{messageValue}',
        ],
    ],
    /**
     * @example
     */
    '_ZendFilterAdapter' => [
        'name' => 'fieldName',
        'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
        'zendFilter' => '{Zend\Filter\SomeClass}',
        'zendFilterOptions' => [
            // options to be passed to zend filter
        ],
    ],
    /**
     * @example
     */
    '_ZendValidatorAdapter' => [
        'name' => 'fieldName',
        'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
        'zendValidator' => '{Zend\Filter\SomeClass}',
        'zendValidatorOptions' => [
            // options to be passed to zend validator
        ],
        // message over-ride
        'messages' => [
            '{code}' => '{messageValue}',
        ],
    ],
    /* USABLE EXAMPLES */

    /**
     * @example
     */
    'ZendValidatorStringLength' => [
        'name' => 'myField',
        'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
        'zendValidator' => Zend\Validator\StringLength::class,
        'zendValidatorOptions' => [
            'min' => 2,
            'max' => 4,
        ],
        'messages' => [
            'invalid' => 'Not even close!',
            'stringLengthTooShort' => 'Tooo short dude!',
            'stringLengthTooLong' => 'Tooo long man!',
        ],
    ],
    /**
     * @example
     */
    'ZendFilterStripTags' => [
        'name' => 'myField',
        'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
        'zendFilter' => Zend\Filter\StripTags::class,
        'zendFilterOptions' => [
            'tagsAllowed' => ['br']
        ],
    ],
    /**
     * @example
     */
    'ZendCollection' => [
        'name' => 'myField',
        'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
        'processors' => [
            [
                'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                'zendValidator' => Zend\Validator\StringLength::class,
                'zendValidatorOptions' => [
                    'min' => 2,
                    'max' => 4,
                ],
                'messages' => [
                    'invalid' => 'Not even close!',
                    'stringLengthTooShort' => 'Tooo short dude!',
                    'stringLengthTooLong' => 'Tooo long man!',
                ],
            ],
            [
                'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                'zendValidator' => Zend\Validator\NotEmpty::class,
                'zendValidatorOptions' => [
                    'type' => 'all',
                ],
                'messages' => [
                    \Zend\Validator\NotEmpty::IS_EMPTY => 'Value must not be empty',
                ],
            ],
            [
                'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                'zendFilter' => Zend\Filter\StripTags::class,
                'zendFilterOptions' => [
                    'tagsAllowed' => ['br']
                ],
            ],
        ],
        'messages' => [
            'invalid' => 'Set failed!',
        ],
    ],
    /**
     * @example
     */
    'FieldSetProcessor' => [
        'name' => 'FieldSetProcessor',
        'processor' => Jerv\Validation\Processor\FieldSetProcessor::class,
        'field-set' => [
            'field1' => [
                'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                'processors' => [
                    [
                        'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                        'zendFilter' => Zend\Filter\StripTags::class,
                        'zendFilterOptions' => [
                            'tagsAllowed' => ['br'],
                        ],
                    ],
                    [
                        'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                        'zendValidator' => Zend\Validator\NotEmpty::class,
                        'zendValidatorOptions' => [
                            'type' => 'all',
                        ],
                        'messages' => [
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Value must not be empty',
                        ],
                    ],
                    [
                        'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                        'zendValidator' => Zend\Validator\StringLength::class,
                        'zendValidatorOptions' => [
                            'min' => 2,
                            'max' => 4,
                        ],
                        'messages' => [
                            'invalid' => 'Not even close!',
                            'stringLengthTooShort' => 'Tooo short dude!',
                            'stringLengthTooLong' => 'Tooo long man!',
                        ],
                    ],
                ],
            ],
            'field2' => [
                'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                'processors' => [
                    [
                        'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                        'zendValidator' => Zend\Validator\StringLength::class,
                        'zendValidatorOptions' => [
                            'min' => 2,
                            'max' => 4,
                        ],
                        'messages' => [
                            'invalid' => 'Not even close!',
                            'stringLengthTooShort' => 'Tooo short dude!',
                            'stringLengthTooLong' => 'Tooo long man!',
                        ],
                    ],
                    [
                        'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                        'zendFilter' => Zend\Filter\StripTags::class,
                        'zendFilterOptions' => [
                            'tagsAllowed' => ['br']
                        ],
                    ],
                ],
            ],
            'sub-set1' => [
                'name' => 'sub-set1',
                'processor' => Jerv\Validation\Processor\FieldSetProcessor::class,
                'field-set' => [
                    'field11' => [
                        'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                        'processors' => [
                            [
                                'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                                'zendValidator' => Zend\Validator\NotEmpty::class,
                            ],
                        ],
                    ],
                    'field12' => [
                        'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                        'processors' => [
                            [
                                'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                                'zendValidator' => Zend\Validator\NotEmpty::class,
                            ],
                        ],
                    ],
                    'sub-set2' => [
                        'name' => 'sub-set2',
                        'processor' => Jerv\Validation\Processor\FieldSetProcessor::class,
                        'field-set' => [
                            'field111' => [
                                'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                                'processors' => [
                                    [
                                        'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                                        'zendValidator' => Zend\Validator\NotEmpty::class,
                                    ],
                                ],
                            ],
                            'field112' => [
                                'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                                'processors' => [
                                    [
                                        'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                                        'zendValidator' => Zend\Validator\NotEmpty::class,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        // message over-ride
        'messages' => [
            'field-setInvalid' => 'Set failed!',
        ],
    ],
    /**
     * @FlatConfigFormat
     */
    /*
    'FlatConfigFormat2' => [
        '_messages' => ['{FieldSetProcessorMessages}']
        '{field-name}' => [
            ['{ProcessorCollectionConfig}'],
        ],
        '{field-name}._messages' => ['{ProcessorCollectionMessages}'],
    ],
    */
    'FlatConfigFormat' => [
        'options-class' => \Jerv\Validation\Options\FlatOptions::class,
        'result-parser-class' => \Jerv\Validation\ResultParser\FlatMessagesResultParser::class,
        'messages' => [
            'field-setInvalid' => 'Field set is invalid!',
        ],
        'field-set' => [
            'field1' => [
                [
                    'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                    'zendFilter' => Zend\Filter\StripTags::class,
                    'zendFilterOptions' => [
                        'tagsAllowed' => ['br']
                    ],
                ],
            ],
            'field2' => [
                [
                    'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                    'zendValidator' => Zend\Validator\StringLength::class,
                    'zendValidatorOptions' => [
                        'min' => 2,
                        'max' => 4,
                    ],
                    'messages' => [
                        'invalid' => 'Not even close!',
                        'stringLengthTooShort' => 'Tooo short dude!',
                        'stringLengthTooLong' => 'Tooo long man!',
                    ],
                ],
                [
                    'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                    'zendValidator' => Zend\Validator\NotEmpty::class,
                    'zendValidatorOptions' => [
                        'type' => 'all',
                    ],
                    'messages' => [
                        \Zend\Validator\NotEmpty::IS_EMPTY => 'Value must not be empty',
                    ],
                ],
            ],
            'sub-set1.field11' => [
                [
                    'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                    'zendValidator' => Zend\Validator\StringLength::class,
                    'zendValidatorOptions' => [
                        'min' => 2,
                        'max' => 4,
                    ],
                    'messages' => [
                        'invalid' => 'Not even close!',
                        'stringLengthTooShort' => 'Tooo short dude!',
                        'stringLengthTooLong' => 'Tooo long man!',
                    ],
                ],
                [
                    'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                    'zendValidator' => Zend\Validator\NotEmpty::class,
                    'zendValidatorOptions' => [
                        'type' => 'all',
                    ],
                    'messages' => [
                        \Zend\Validator\NotEmpty::IS_EMPTY => 'Value must not be empty',
                    ],
                ],
            ],
            'sub-set1.field12' => [
                [
                    'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                    'zendFilter' => Zend\Filter\StripTags::class,
                    'zendFilterOptions' => [
                        'tagsAllowed' => ['br']
                    ],
                ],
            ],
            'sub-set1.sub-set2.field111' => [
                [
                    'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                    'zendFilter' => Zend\Filter\StripTags::class,
                    'zendFilterOptions' => [
                        'tagsAllowed' => ['br']
                    ],
                ],
            ],
            'sub-set1.sub-set2.field111._messages' => [
                'field-setInvalid' => 'set bad!',
            ],
            'sub-set1.sub-set2.field112' => [
                [
                    'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                    'zendFilter' => Zend\Filter\StripTags::class,
                    'zendFilterOptions' => [
                        'tagsAllowed' => ['br']
                    ],
                ],
            ],
        ],
    ],
];
