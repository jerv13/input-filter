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
 * For testing only
 * {my-site.com}/jerv-validation/example?example=FieldSetProcessor
 *
 * @author    James Jervis
 * @license   License.txt
 * @link      https://github.com/jerv13
 */
class ExampleController
{
    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @var InputFilterService
     */
    protected $inputFilterService;

    /**
     * @var string
     */
    protected $defaultExample = 'FieldSetProcessor';

    /**
     * @var array
     */
    protected $exampleConfig = [];

    /**
     * Constructor.
     *
     * @param                    $config
     * @param InputFilterService $inputFilterService
     */
    public function __construct(
        $config,
        InputFilterService $inputFilterService
    ) {
        $this->inputFilterService = $inputFilterService;
        $this->enabled = $config['jerv-validation']['example-controller-enabled'];
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
        if(!$this->enabled) {
            return $response->withStatus(404);
        }
        $fields = $request->getParsedBody();

        $queryParams = $request->getQueryParams();

        $exampleConfig = $this->getExampleConfig($queryParams);

        $result = $this->inputFilterService->process(
            $fields,
            $exampleConfig
        );

        $return = $result->toArray();

        return new JsonResponse(
            $return
        );
    }
}
