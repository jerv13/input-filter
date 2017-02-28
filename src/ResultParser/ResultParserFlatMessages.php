<?php

namespace Jerv\Validation\ResultParser;

use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\Result;

class ResultParserFlatMessages implements ResultParser
{
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
        $results = $result->getResults();

        $messages = $result->getMessages();

        $this->flatten(null, $results, $messages);

        $result->setMessages($messages);
    }

    protected function flatten($parentName = null, $results, &$messages)
    {
        /** @var Result $result */
        foreach ($results as $result) {

            if ($result->hasMessages()) {
                $this->flatten(
                    $result->getName(),
                    $result->getResults(),
                    $messages
                );
                continue;
            }

            $compositeKey = $this->buildKey($parentName, $sourceValue);

            $this->flatten($compositeKey, $sourceValue, $destination);

            $destination[$compositeKey] = $sourceValue;
        }
    }

    /**
     * buildKey
     *
     * @param string|null $parentKey
     * @param Result      $sourceValue
     *
     * @return string
     */
    protected function buildKey($parentKey, $sourceValue)
    {
        $sourceName = $sourceValue->getName();

        if ($parentKey === null) {
            return $sourceName;
        }

        return $parentKey . '.' . $sourceName;
    }
}
