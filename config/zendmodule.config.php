<?php
return [
    /* InputFilter Config */
    'jerv-validation' => include __DIR__ . '/jerv.validator.config.php',
    /* Controllers */
    'controllers' => [
        'factories' => [
            Jerv\Validation\Zend\Controller\ExampleController::class
            => Jerv\Validation\Zend\Controller\ExampleControllerFactory::class,
        ],
    ],
    /* Routes */
    'router' => [
        'routes' => [
            'jerv-validation.example' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => 'jerv-validation/example[/:id]',
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
            => Jerv\Validation\Zend\ServiceManager\AdapterFactory::class,
            /* InputFilterService */
            Jerv\Validation\Service\InputFilterService::class
            => Jerv\Validation\Service\InputFilterServiceFactory::class,
            /* Processors */
            Jerv\Validation\Processor\DataSetProcessor::class
            => Jerv\Validation\Processor\DataSetProcessorFactory::class,
            Jerv\Validation\Processor\ProcessorCollection::class
            => Jerv\Validation\Processor\ProcessorCollectionFactory::class,
            /* Zend Processor Adapters */
            Jerv\Validation\Zend\Filter\Adapter::class
            => Jerv\Validation\Zend\Filter\AdapterFactory::class,
            Jerv\Validation\Zend\Validator\Adapter::class
            => Jerv\Validation\Zend\Validator\AdapterFactory::class,
            /* Result Parsers */
            Jerv\Validation\ResultParser\DefaultResultParser::class
            => Jerv\Validation\ResultParser\DefaultResultParserFactory::class
        ]
    ],
    /* View Manager */
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
