<?php
return [
    /* InputFilter Config */
    'JervDesign\\InputFilter' => include __DIR__ . '/inputfilter.config.php',
    /* Controllers */
    'controllers' => [
        'invokables' => [
            'JervDesign\InputFilter\Zend\Controller\ExampleController'
            => 'JervDesign\InputFilter\Zend\Controller\ExampleController',
        ],
    ],
    /* Routes */
    'router' => [
        'routes' => [
            '/inputfilterexample' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/inputfilterexample/:id',
                    'defaults' => [
                        'controller' => 'JervDesign\InputFilter\Zend\Controller\ExampleController',
                    ]
                ],
            ],
        ],
    ],
    /* Zend Service Manager */
    'service_manager' => [
        'factories' => [
            /* ServiceLocator */
            'JervDesign\InputFilter\ServiceLocator'
            => 'JervDesign\InputFilter\Zend\Factory\ServiceLocatorFactory',
            /* InputFilterService */
            'JervDesign\InputFilter\Service\InputFilterService'
            => 'JervDesign\InputFilter\Zend\Factory\InputFilterServiceFactory',
            /* Processors */
            'JervDesign\InputFilter\Processor\DataSetProcessor'
            => 'JervDesign\InputFilter\Zend\Factory\DataSetProcessorFactory',
            'JervDesign\InputFilter\Processor\ProcessorCollection'
            => 'JervDesign\InputFilter\Zend\Factory\ProcessorCollectionFactory',
            /* Zend Processor Adapters */
            'JervDesign\InputFilter\Zend\Filter\Adapter'
            => 'JervDesign\InputFilter\Zend\Factory\FilterAdapterFactory',
            'JervDesign\InputFilter\Zend\Validator\Adapter'
            => 'JervDesign\InputFilter\Zend\Factory\ValidatorAdapterFactory',
        ]
    ],
    /* View Manager */
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

];
