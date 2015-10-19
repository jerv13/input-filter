<?php

namespace JervDesign\InputFilter\ResultParser;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Result\Result;
use JervDesign\InputFilter\ServiceLocator;

/**
 * Class ResultParsers Composite ResultParser
 */
class ResultParsers implements ResultParser
{

    protected $serviceLocator;
    /**
     * array [ResultParser]
     */
    protected $resultParsers = [];

    /**
     * @param ServiceLocator $serviceLocator
     * @param array          $parserConfig ['ParserServiceName']
     */
    public function __construct(
        ServiceLocator $serviceLocator,
        $parserConfig
    ) {
        $this->serviceLocator = $serviceLocator;
        $this->buildParsers($parserConfig);
    }

    /**
     * buildParsers
     *
     * @param array $parserConfig ['ParserServiceName']
     *
     * @return void
     */
    public function buildParsers($parserConfig)
    {
        $this->resultParsers = [];

        foreach ($parserConfig as $resultParserServiceName) {
            /** @var ResultParser $parser */
            $parser = $this->serviceLocator->get($resultParserServiceName);
            $this->add($parser);
        }
    }

    /**
     * add
     *
     * @param ResultParser $resultParser
     *
     * @return void
     */
    public function add(ResultParser $resultParser)
    {
        $this->resultParsers[] = $resultParser;
    }

    /**
     * parse
     *
     * @param Result  $result
     * @param Options $options
     *
     * @return Result
     */
    public function parse(Result $result, Options $options)
    {
        /** @var ResultParser $resultParser */
        foreach ($this->resultParsers as $resultParser) {
            $result = $resultParser->parse($result, $options);
        }

        return $result;
    }
}
