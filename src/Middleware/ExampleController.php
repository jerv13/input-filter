<?php

namespace Jerv\Validation\Middleware;

use Jerv\Validation\Service\InputFilterService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class ExampleController
 *
 * @author    James Jervis
 * @license   License.txt
 * @link      https://github.com/jerv13
 */
class ExampleController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $defaultExample = '_DEFAULT';

    /**
     * @var array
     */
    protected $exampleConfig = [];

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(
        $container
    ) {
        $this->container = $container;
        $this->exampleConfig = include(
            __DIR__ . '/../../config/example.config.php'
        );
    }

    /**
     * getExampleConfig
     *
     * @param $exampleKey
     *
     * @return mixed
     */
    protected function getExampleConfig($exampleKey)
    {
        return $this->getExample($exampleKey);
    }

    /**
     * getExample
     *
     * @param $key
     *
     * @return mixed
     */
    protected function getExample($key)
    {
        if (!$this->exampleConfig[$key]) {
            return $this->exampleConfig[$this->defaultExample];
        }

        return $this->exampleConfig[$key];
    }

    /**
     * __invoke
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $fields = $request->getParsedBody();

        $queryParams = $request->getQueryParams();

        $exampleKey = $this->defaultExample;

        if (array_key_exists('example', $queryParams)) {
            $exampleKey = $queryParams['example'];
        }

        $exampleConfig = $this->getExampleConfig($exampleKey);

        /** @var \Jerv\Validation\Service\InputFilterService $inputFilterService */
        $inputFilterService = $this->container->get(
            InputFilterService::class
        );

        $result = $inputFilterService->process($fields, $exampleConfig);

        $return = $result->toArray();

        return new JsonResponse(
            $return
        );
    }
}
