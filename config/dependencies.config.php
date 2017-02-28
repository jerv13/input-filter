<?php
/**
 * dependencies.config.php
 */
return [
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
        Jerv\Validation\Processor\FieldSetProcessor::class
        => Jerv\Validation\Processor\FieldSetProcessorFactory::class,

        Jerv\Validation\Processor\FlatFieldSetProcessor::class
        => Jerv\Validation\Processor\FlatFieldSetProcessorFactory::class,

        Jerv\Validation\Processor\ProcessorCollection::class
        => Jerv\Validation\Processor\ProcessorCollectionFactory::class,

        /* Zend Processor Adapters */
        Jerv\Validation\Zend\Filter\Adapter::class
        => Jerv\Validation\Zend\Filter\AdapterFactory::class,

        Jerv\Validation\Zend\Validator\Adapter::class
        => Jerv\Validation\Zend\Validator\AdapterFactory::class,

        /* Result Parsers */
        Jerv\Validation\ResultParser\DefaultResultParser::class
        => Jerv\Validation\ResultParser\DefaultResultParserFactory::class,

        Jerv\Validation\ResultParser\FlatMessagesResultParser::class
        => Jerv\Validation\ResultParser\FlatMessagesResultParserFactory::class,
    ]
];
