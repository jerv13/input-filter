<?php

namespace Jerv\Validation\Processor;

use Jerv\Validation\Exception\ProcessorException;
use Jerv\Validation\Options\Options;
use Jerv\Validation\Result\ProcessorResult;

/**
 * Class DataSetFlatProcessor
 *
 * @author    James Jervis
 * @license   License.txt
 * @link      https://github.com/jerv13
 */
class DataSetFlatProcessor extends DataSetProcessor implements Processor
{
    /**
     * process
     *
     * @param mixed   $data
     * @param Options $options
     *
     * @return ProcessorResult
     * @throws \Exception
     */
    public function process($data, Options $options)
    {
        $data = $this->flattenData($data);

        return parent::process($data, $options);
    }

    /**
     * flattenData
     *
     * @param array|\Traversable $data
     *
     * @return array
     * @throws ProcessorException
     */
    protected function flattenData($data)
    {
        if (!$this->isTraversable($data)) {
            throw new ProcessorException('Data must be array');
        }

        $flattenedData = [];
        $this->flatten(null, $data, $flattenedData);

        return $flattenedData;
    }

    /**
     * flatten into 1 dim array with composite keys
     *
     * @param null               $parentKey
     * @param array|\Traversable $source
     * @param array              $destination
     *
     * @return void
     */
    protected function flatten($parentKey = null, $source, &$destination)
    {
        foreach ($source as $sourceKey => $sourceValue) {
            $compositeKey = $this->buildKey($parentKey, $sourceKey);

            if ($this->isTraversable($sourceValue)) {
                $this->flatten($compositeKey, $sourceValue, $destination);
                continue;
            }

            $destination[$compositeKey] = $sourceValue;
        }
    }

    /**
     * buildKey
     *
     * @param string|null $parentKey
     * @param string|int  $sourceKey
     *
     * @return string
     */
    protected function buildKey($parentKey, $sourceKey)
    {
        if ($parentKey === null) {
            return $sourceKey;
        }

        return $parentKey . '.' . $sourceKey;
    }

    /**
     * isTraversable
     *
     * @param mixed $data
     *
     * @return bool
     */
    protected function isTraversable($data)
    {
        return (is_array($data) || $data instanceof \Traversable);
    }
}
