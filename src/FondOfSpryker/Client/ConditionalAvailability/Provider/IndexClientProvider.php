<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Provider;

use Elastica\Index;
use FondOfSpryker\Shared\ConditionalAvailability\Provider\AbstractIndexClientProvider;

/**
 * Class IndexClientProvider
 *
 * @desc Needed because to change index via own implemented "AbstractIndexClientProvider"
 *
 * @package FondOfSpryker\Client\ConditionalAvailability\Provider
 */
class IndexClientProvider extends AbstractIndexClientProvider
{
    /**
     * @param string|null $index
     *
     * @return \Elastica\Index
     */
    public function getClient($index = null): Index
    {
        return $this->createZedClient($index);
    }
}
