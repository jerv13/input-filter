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
            'fieldSet' => [
                [
                    'name' => 'fieldName',
                    'processor' => 'JervDesign\InputFilter\Processors',
                    'processors' => [
                        [
                            'processor' => 'JervDesign\InputFilter\Processors',
                        ]

                    ],
                    'messages' => [
                        [
                            'code' => 'myCode',
                            'message' => '{messageValue}',
                            'params' => [
                                '{paramName}' => '{paramValue}'
                            ]
                        ]
                    ]
                ]
            ],
            'messages' => [
                [
                    'code' => 'myCode',
                    'message' => '{messageValue}',
                    'params' => [
                        '{paramName}' => '{paramValue}'
                    ]
                ]
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [

        ]
    ],
];
