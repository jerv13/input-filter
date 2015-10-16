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
    'ZendDataSetProcessor' => [
        'name' => 'myFieldSet',
        'processor' => 'JervDesign\InputFilter\Processor\DataSetProcessor',
        'dataSet' => [
            'myField' => [
                'name' => 'myField',
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
                'messages' => [
                    'Invalid' => 'Not likely!',
                ],
            ],
            'yourField' => [
                'name' => 'yourField',
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
                    'invalid' => 'Not today!',
                ],
            ],
        ],
        // message over-ride
        'messages' => [
            'invalid' => 'Nope!',
        ],
    ],
];
