<?php
return [
    /**
     * Dependencies
     */
    'dependencies' => include __DIR__ . '/dependencies.config.php',
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
