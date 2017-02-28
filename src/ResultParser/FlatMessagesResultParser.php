<?php

namespace Jerv\Validation\ResultParser;

use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\Result;

/**
 * Class FlatMessagesResultParser
 *
 * @author    James Jervis
 * @license   License.txt
 * @link      https://github.com/jerv13
 */
class FlatMessagesResultParser implements ResultParser
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

        return $result;
    }

    /**
     * flatten
     *
     * @param null $parentName
     * @param      $results
     * @param      $compositeMessages
     *
     * @return void
     */
    protected function flatten($parentName = null, array $results, &$compositeMessages)
    {
        /** @var Result $result */
        foreach ($results as $result) {
            $hasResults = $result->hasResults();
            $name = $result->getName();
            if ($hasResults) {
                $this->flatten(
                    $result->getName(),
                    $result->getResults(),
                    $compositeMessages
                );
            }

            $this->flattenMessages($name, $result->getMessages(), $compositeMessages);
        }
    }

    /**
     * flattenMessages
     *
     * @param $parentName
     * @param $messages
     * @param $compositeMessages
     *
     * @return void
     */
    protected function flattenMessages($parentName, $messages, &$compositeMessages)
    {
        foreach ($messages as $code => $message) {
            $compositeCode = $this->buildCode($parentName, $code);

            $compositeMessages[$compositeCode] = $message;
        }
    }

    /**
     * buildCode
     *
     * @param string $parentName
     * @param string $code
     *
     * @return string
     */
    protected function buildCode($parentName, $code)
    {
        if ($parentName === null) {
            return $code;
        }

        return $parentName . '.' . $code;
    }
}
