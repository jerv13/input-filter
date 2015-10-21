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
        'processor' => 'JervDesign\InputFilter\Processor\DataSetProcessor',
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
        'processor' => 'JervDesign\InputFilter\Processor\ProcessorCollection',
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
        'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
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
        'processor' => 'JervDesign\InputFilter\Zend\Validator\Adapter',
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
        'processor' => 'JervDesign\InputFilter\Zend\Validator\Adapter',
        'zendValidator' => 'Zend\Validator\StringLength',
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
        'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
        'zendFilter' => 'Zend\Filter\StripTags',
        'zendFilterOptions' => [
            'tagsAllowed' => '<br>'
        ],
    ],
    /**
     * @example
     */
    'ZendCollection' => [
        'name' => 'myField',
        'processor' => 'JervDesign\InputFilter\Processor\ProcessorCollection',
        'processors' => [
            [
                'processor' => 'JervDesign\InputFilter\Zend\Validator\Adapter',
                'zendValidator' => 'Zend\Validator\StringLength',
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
                'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
                'zendFilter' => 'Zend\Filter\StripTags',
                'zendFilterOptions' => [
                    'tagsAllowed' => '<br>'
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
        'name' => 'myFieldSet',
        'processor' => 'JervDesign\InputFilter\Processor\DataSetProcessor',
        'dataSet' => [
            'myField' => [
                'processor' => 'JervDesign\InputFilter\Processor\ProcessorCollection',
                'processors' => [
                    [
                        'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
                        'zendFilter' => 'Zend\Filter\StripTags',
                        'zendFilterOptions' => [
                            'tagsAllowed' => '<br>'
                        ],
                    ],
                    [
                        'processor' => 'JervDesign\InputFilter\Zend\Validator\Adapter',
                        'zendValidator' => 'Zend\Validator\StringLength',
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
                'processor' => 'JervDesign\InputFilter\Processor\ProcessorCollection',
                'processors' => [
                    [
                        'processor' => 'JervDesign\InputFilter\Zend\Validator\Adapter',
                        'zendValidator' => 'Zend\Validator\StringLength',
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
                        'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
                        'zendFilter' => 'Zend\Filter\StripTags',
                        'zendFilterOptions' => [
                            'tagsAllowed' => '<br>'
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
                'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
                'zendFilter' => 'Zend\Filter\StripTags',
                'zendFilterOptions' => [
                    'tagsAllowed' => '<br>'
                ],
            ],
        ],
        'someField2' => [
            [
                'processor' => 'JervDesign\InputFilter\Zend\Validator\Adapter',
                'zendValidator' => 'Zend\Validator\StringLength',
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
                'processor' => 'JervDesign\InputFilter\Zend\Validator\Adapter',
                'zendValidator' => 'Zend\Validator\StringLength',
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
                'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
                'zendFilter' => 'Zend\Filter\StripTags',
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
                'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
                'zendFilter' => 'Zend\Filter\StripTags',
                'zendFilterOptions' => [
                    'tagsAllowed' => '<br>'
                ],
            ],
        ],
        'fieldSet.fieldSet1._messages' => [
            'dataSetInvalid' => 'fieldSet bad!',
        ],
    ],
    'SimpleConfigFormat' => [

        '_messages' => ['root'],
        'f1' => [
            'f1-config'
        ],
        's1.f11' => [
            's1.f11-config'
        ],
        's1.f12' => [
            's1.f12-config'
        ],
        's1._messages' => ['s1'],
    ],
];
