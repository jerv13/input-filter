<?php
return [
    /**
     * Configuration
     */
    'JervDesign\\InputFilter' => [
        'messageParsers' => [
            'JervDesign\InputFilter\Message\ParamsMessageParser'
        ],
    ],
    // message params?
    'messageParams' => [
        '{code}' => [
            '{paramName}' => '{paramValue}'
        ],
    ],

    /**
     * @example
     */
    'My\InputFilterService' => [
        'name' => 'fieldName',
        'processor' => '{ProcessorService}',
        '{ProcessorServiceOptionKey}' => "{ProcessorServiceOptionValue}",
        // message over-ride
        'messages' => [
            '{code}' => '{messageValue}',
        ],
    ],

    /**
     * @example
     */
    'My\DataSetProcessor' => [
        'name' => 'fieldSetName',
        'processor' => 'JervDesign\InputFilter\DataSetProcessor',
        'dataSet' => [
            [
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
    'My\ProcessorCollection' => [
        'name' => 'fieldName',
        'processor' => 'JervDesign\InputFilter\ProcessorCollection',
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
    'My\Zend\Filter\Adapter' => [
        'name' => 'fieldName',
        'processor' => 'JervDesign\InputFilter\Zend\Filter\Adapter',
        'zendFilter' => '{Zend\Filter\SomeClass}',
        'zendFilterOptions' => [
            // options to be passed to zend filter
        ],
        // message over-ride
        'messages' => [
            '{code}' => '{messageValue}',
        ],
    ],
    /**
     * @example
     */
    'My\Zend\Validator\Adapter' => [
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
    /* */
    'service_manager' => [
        'factories' => [

        ]
    ],
];
