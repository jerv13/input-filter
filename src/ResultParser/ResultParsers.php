<?php

namespace JervDesign\InputFilter\ResultParser;

use JervDesign\InputFilter\Options\Options;
use JervDesign\InputFilter\Result\Result;

/**
 * Class ResultParsers Composite ResultParser
 */
class ResultParsers implements ResultParser
{
    /**
     * array [ResultParser]
     */
    protected $resultParsers = [];

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
