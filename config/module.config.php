<?php
return [
    /**
     * Dependencies
     */
    'dependencies' => [
        'factories' => [
            Jerv\Validation\Middleware\ExampleController::class
            => Jerv\Validation\Middleware\ExampleControllerFactory::class,
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
    /**
     * InputFilter Config
     */
    'jerv-validation' => include __DIR__ . '/jerv.validator.config.php',
    /**
     * routes
     */
    'routes' => [
        [
            'name' => 'jerv-validation.example',
            'path' => '/jerv-validation/example',
            'middleware' => [
                Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class,
                Jerv\Validation\Middleware\ExampleController::class,
            ],
            'options' => [],
            'allowed_methods' => ['POST'],
        ],
    ],
];
