<?php

namespace Jerv\Validation\Middleware;

use Jerv\Validation\Options\ArrayOptions;
use Jerv\Validation\Options\FlatOptions;
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
     * getExampleKey
     *
     * @param array $queryParams
     *
     * @return string
     */
    protected function getExampleKey($queryParams)
    {
        if (array_key_exists('example', $queryParams)) {
            return $queryParams['example'];
        }

        return $this->defaultExample;
    }

    /**
     * getExampleConfig
     *
     * @param array $queryParams
     *
     * @return mixed
     */
    protected function getExampleConfig($queryParams)
    {
        $exampleKey = $this->getExampleKey($queryParams);

        return $this->getExample($exampleKey);
    }

    /**
     * getOptionsClass
     *
     * @param array $queryParams
     *
     * @return mixed
     */
    protected function getOptionsClass($queryParams)
    {
        if (array_key_exists('options-class', $queryParams)) {
            return urldecode($queryParams['options-class']);
        }

        return ArrayOptions::class;
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

        $exampleConfig = $this->getExampleConfig($queryParams);

        $optionsClass = $this->getOptionsClass($queryParams);

        /** @var \Jerv\Validation\Service\InputFilterService $inputFilterService */
        $inputFilterService = $this->container->get(
            InputFilterService::class
        );

        $result = $inputFilterService->process(
            $fields,
            $exampleConfig,
            $optionsClass
        );

        $return = $result->toArray();

        return new JsonResponse(
            $return
        );
    }
}
