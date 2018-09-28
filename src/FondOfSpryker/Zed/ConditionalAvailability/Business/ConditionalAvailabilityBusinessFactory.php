<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;


use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\SearchConfig getConfig()
 */
class ConditionalAvailabilityBusinessFactory extends \Spryker\Zed\Search\Business\SearchBusinessFactory
{
    /**
     * @return \Spryker\Client\Search\Provider\IndexClientProvider
     */
    protected function createIndexProvider()
    {
        return new IndexClientProvider();
    }

}
