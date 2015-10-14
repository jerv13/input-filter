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
    'exampleConfig' => [
        [
            'name' => 'fieldSetName',
            'processor' => 'JervDesign\InputFilter\DataSetProcessor',
            'dataSet' => [
                [
                    'name' => 'fieldName',
                    'processor' => 'JervDesign\InputFilter\Processors',
                    'processors' => [
                        [
                            'processor' => 'JervDesign\InputFilter\Processors',
                            'messages' => [
                                '{code}' =>'{messageValue}',
                            ],
                        ]

                    ],
                    'messages' => [
                        '{code}' =>'{messageValue}',
                    ],
                ]
            ],
            // message over-ride
            'messages' => [
                '{code}' =>'{messageValue}',
            ],
            // message params?
            'messageParams' => [
                '{code}' =>[
                    '{paramName}' => '{paramValue}'
                ],
            ],
        ]
    ],
    'service_manager' => [
        'factories' => [

        ]
    ],
];
