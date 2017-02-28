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
    '_DataSetProcessor' => [
        'name' => 'setName',
        'processor' => Jerv\Validation\Processor\DataSetProcessor::class,
        'dataSet' => [
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
    'ZendDataSetProcessor' => [
        'name' => 'ZendDataSetProcessor',
        'processor' => Jerv\Validation\Processor\DataSetProcessor::class,
        'dataSet' => [
            'myField' => [
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
            'yourField' => [
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
            'subset' => [
                'name' => 'subset',
                'processor' => Jerv\Validation\Processor\DataSetProcessor::class,
                'dataSet' => [
                    'myField' => [
                        'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                        'processors' => [
                            [
                                'processor' => Jerv\Validation\Zend\Validator\Adapter::class,
                                'zendValidator' => Zend\Validator\NotEmpty::class,
                            ],
                        ],
                    ],
                    'yourField' => [
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
        // message over-ride
        'messages' => [
            'dataSetInvalid' => 'Set failed!',
        ],
    ],
    /**
     * @SimpleConfigFormat
     */
    /*
    'SimpleConfigFormat2' => [
        '_messages' => ['{DataSetProcessorMessages}']
        '{field-name}' => [
            ['{ProcessorCollectionConfig}'],
        ],
        '{field-name}._messages' => ['{ProcessorCollectionMessages}'],
    ],
    */
    'SimpleConfigFormat' => [
        '_messages' => [
            'dataSetInvalid' => 'Root bad!',
        ],
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
        'set.field11' => [
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
        'set.field12' => [
            [
                'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                'zendFilter' => Zend\Filter\StripTags::class,
                'zendFilterOptions' => [
                    'tagsAllowed' => ['br']
                ],
            ],
        ],
        'set.set1.field12' => [
            [
                'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                'zendFilter' => Zend\Filter\StripTags::class,
                'zendFilterOptions' => [
                    'tagsAllowed' => ['br']
                ],
            ],
        ],
        'set.set1.field12._messages' => [
            'dataSetInvalid' => 'set bad!',
        ],
    ],
];
