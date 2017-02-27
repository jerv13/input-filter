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
        'name' => 'fieldSetName',
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
                'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                'zendFilter' => Zend\Filter\StripTags::class,
                'zendFilterOptions' => [
                    'tagsAllowed' => ['br']
                ],
            ],
        ],
        'messages' => [
            'invalid' => 'Nope!',
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
            'dataSetInvalid' => 'Nope!',
        ],
    ],
    /**
     * @SimpleConfigFormat
     */
    'SimpleConfigFormat' => [
        '_messages' => [
            'dataSetInvalid' => 'Root bad!',
        ],
        'someField1' => [
            [
                'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                'zendFilter' => Zend\Filter\StripTags::class,
                'zendFilterOptions' => [
                    'tagsAllowed' => '<br>'
                ],
            ],
        ],
        'someField2' => [
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
//        'someField1._messages' => [
//            'dataSetInvalid' => 'someField1 is wrong',
//        ],
        'fieldSet.someField11' => [
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
        'fieldSet.someField12' => [
            [
                'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                'zendFilter' => Zend\Filter\StripTags::class,
                'zendFilterOptions' => [
                    'tagsAllowed' => '<br>'
                ],
            ],
        ],
        'fieldSet._messages' => [
            'dataSetInvalid' => 'fieldSet bad!',
        ],
        'fieldSet.fieldSet1.someField12' => [
            [
                'processor' => Jerv\Validation\Zend\Filter\Adapter::class,
                'zendFilter' => Zend\Filter\StripTags::class,
                'zendFilterOptions' => [
                    'tagsAllowed' => '<br>'
                ],
            ],
        ],
        'fieldSet.fieldSet1._messages' => [
            'dataSetInvalid' => 'fieldSet bad!',
        ],
    ],
    'SimpleConfigFormat2' => [
        '{field-path}' => [
            // Processor collection
            '{field-name}' => [['{ProcessorConfig}']]
        ]
    ],
    'SimpleConfigFormat3' => [
        '_messages' => ['root'],
        'f1' => [
            'f1-config'
        ],
        'f2' => [
            'f2-config'
        ],
        's1.f11' => [
            's1.f11-config'
        ],
        's1.f12' => [
            's1.f12-config'
        ],
        's1.s11.f111' => [
            's1.s11.f111-config'
        ],
        's1.s12.f112' => [
            's1.s12.f112-config'
        ],
        's1.s12._messages' => ['s1'],
    ],
    'SimpleConfigFormatProcessed' => [
        'name' => 'myFieldSet',
        'processor' => Jerv\Validation\Processor\DataSetProcessor::class,
        'dataSet' => [
            'f1' => [
                'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                'processors' => ['f1-config'],
            ],
            'f2' => [
                'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                'processors' => ['f2-config'],
            ],
            's1' => [
                'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                'processors' => ['f2-config'],
            ],
            'f2' => [
                'processor' => Jerv\Validation\Processor\ProcessorCollection::class,
                'processors' => ['f2-config'],
            ],
        ],
    ],
];
