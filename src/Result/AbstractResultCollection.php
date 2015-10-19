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
