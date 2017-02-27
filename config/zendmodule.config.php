<?php
return [
    /* InputFilter Config */
    'Jerv\\Validation' => include __DIR__ . '/jerv.validator.config.php',
    /* Controllers */
    'controllers' => [
        'invokables' => [
            Jerv\Validation\Zend\Controller\ExampleController::class
            => Jerv\Validation\Zend\Controller\ExampleController::class,
        ],
    ],
    /* Routes */
    'router' => [
        'routes' => [
            '/inputfilterexample' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/inputfilterexample[/:id]',
                    'defaults' => [
                        'controller' => Jerv\Validation\Zend\Controller\ExampleController::class,
                    ]
                ],
            ],
        ],
    ],
    /* Zend Service Manager */
    'service_manager' => [
        'factories' => [
            /* ServiceLocator */
            Jerv\Validation\ServiceLocator::class
            => Jerv\Validation\Zend\Factory\ServiceLocatorFactory::class,
            /* InputFilterService */
            Jerv\Validation\Service\InputFilterService::class
            => Jerv\Validation\Zend\Factory\InputFilterServiceFactory::class,
            /* Processors */
            Jerv\Validation\Processor\DataSetProcessor::class
            => Jerv\Validation\Zend\Factory\DataSetProcessorFactory::class,
            Jerv\Validation\Processor\ProcessorCollection::class
            => Jerv\Validation\Zend\Factory\ProcessorCollectionFactory::class,
            /* Zend Processor Adapters */
            Jerv\Validation\Zend\Filter\Adapter::class
            => Jerv\Validation\Zend\Factory\FilterAdapterFactory::class,
            Jerv\Validation\Zend\Validator\Adapter::class
            => Jerv\Validation\Zend\Factory\ValidatorAdapterFactory::class,
            /* Result Parsers */
            Jerv\Validation\ResultParser\DefaultResultParser::class
            => Jerv\Validation\Zend\Factory\DefaultResultParserFactory::class
        ]
    ],
    /* View Manager */
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

];
