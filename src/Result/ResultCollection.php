<?php

namespace JervDesign\InputFilter\Result;

/**
 * Interface ResultCollection
 */
interface ResultCollection extends Result
{
    /**
     * addResult
     *
     * @param Result $result
     *
     * @return void
     */
    public function addChild(Result $result);

    /**
     * getChildren
     *
     * @return array [Result]
     */
    public function getChildren();

    /**
     * mergeChildren
     *
     * @param ResultCollection $resultCollection
     *
     * @return mixed
     */
    public function mergeChildren(
        ResultCollection $resultCollection
    );
}
