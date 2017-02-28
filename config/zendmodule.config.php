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
    'service_manager' => include __DIR__ . '/dependencies.config.php',
    /* View Manager */
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
