<?php
return [
    /**
     * Configuration
     */
    'JervDesign\\InputFilter' => [
    ],
    'exampleConfig' => [
        [
            'name' => 'fieldSetName',
            'processor' => 'JervDesign\InputFilter\FieldSetProcessor',
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
            'messages' => [
                '{code}' =>'{messageValue}',
            ],
//            'messageParams' => [
//                '{code}' =>[
//                    '{paramName}' => '{paramValue}'
//                ],
//            ],
        ]
    ],
    'service_manager' => [
        'factories' => [

        ]
    ],
];
