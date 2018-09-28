<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Provider;

use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants as SearchConstants;
use FondOfSpryker\Shared\ConditionalAvailability\Provider\AbstractIndexClientProvider;

class IndexClientProvider extends AbstractIndexClientProvider
{
    /**
     * @param string|null $index
     *
     * @return \Elastica\Index
     */
    public function getClient($index = null)
    {
        return $this->createZedClient($index);
    }
}
