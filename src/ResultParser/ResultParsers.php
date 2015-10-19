<?php

namespace JervDesign\InputFilter\Message;

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
     * @param ResultParser $ResultParser
     *
     * @return void
     */
    public function add(ResultParser $resultParser)
    {
        $this->resultParsers[] = $resultParser;
    }

    /**
     * parseParams
     *
     * @param string $message
     * @param array  $options
     *
     * @return string
     */
    public function parse($code, $message, array $options = [])
    {
        /** @var ResultParser $ResultParser */
        foreach ($this->resultParsers as $resultParser) {
            $message = $resultParser->parse($code, $message, $options);
        }

        return $message;
    }
}
