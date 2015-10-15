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
    'My\JervDesign\InputFilter\DataSetProcessor' => [
        'name' => 'fieldSetName',
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
    'My\JervDesign\InputFilter\ProcessorCollection' => [
        'name' => 'fieldName',
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
    'My\JervDesign\InputFilter\Service\InputFilterService' => [
        'name' => 'fieldSetName',
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
    'My\JervDesign\Zend\Filter\Adapter' => [
        'name' => 'fieldName',
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
    'My\JervDesign\Zend\Validator\Adapter' => [
        'name' => 'fieldName',
        'zendValidator' => '{Zend\Filter\SomeClass}',
        'zendValidatorOptions' => [
            // options to be passed to zend filter
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
