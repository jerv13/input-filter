<?php

namespace JervDesign\InputFilter\Result;

/**
 * Class AbstractResultCollection
 */
class AbstractResultCollection extends AbstractResult implements ResultCollection
{
    /**
     * @var array
     */
    protected $children = [];

    /**
     * addResult
     *
     * @param Result $result
     *
     * @return void
     */
    public function addChild(Result $result)
    {
        // only add invalid results
        if ($result->isValid()) {
            return;
        }
        $this->children[] = $result;
    }

    /**
     * getChildren
     *
     * @return array [Result]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * mergeChildren
     *
     * @param ResultCollection $resultCollection
     *
     * @return void
     */
    public function mergeChildren(
        ResultCollection $resultCollection
    ) {
        // only merge invalid results
        if ($resultCollection->isValid()) {
            return;
        }

        $this->children = array_merge(
            $resultCollection->getChildren(),
            $this->children
        );
    }

    /**
     * getMessages
     *
     * @param null   $results
     * @param string $ns
     * @param array  $messages
     *
     * @return array
     */
    public function getMessages($results = null, $ns = '', $messages = [])
    {
        if ($results === null) {
            $results = $this->children;
        }

        if (empty($ns)) {
            $ns = $this->getName();
            $messages[$ns] = $this->getMessage();
        }

        /** @var Result $result */
        foreach ($results as $result) {
            if ($result instanceof ResultCollection) {
                $subNs = $ns . '-' . $result->getCode();
                $messages = $this->getMessages(
                    $result->getChildren(),
                    $subNs,
                    $messages
                );
            } else {

            }
        }

        return $messages;
    }

    /**
     * toString
     *
     * @param string $separator
     *
     * @return string
     */
    public function toString($separator = ' | ')
    {
        $messages = $this->getMessages();

        $messageString = ''; //implode($separator, $messages);

        foreach ($messages as $key => $message) {
            $messageString .= $message . $separator;
        }

        return $messageString;
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * toArray
     *
     * @param array $ignore
     *
     * @return array
     */
    public function toArray($ignore = [])
    {
        $data = parent::toArray($ignore);

        if (!in_array('children', $ignore)) {
            $data['children'] = [];
            $children = $this->getChildren();
            /** @var Result $child */
            foreach ($children as $child) {
                $data['children'][] = $child->toArray();
            }
        }

        return $data;
    }
}
