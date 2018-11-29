<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;

use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\Elasticsearch\Generator\IndexMapGenerator;
use Spryker\Zed\Search\Business\SearchBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 */
class ConditionalAvailabilityBusinessFactory extends SearchBusinessFactory
{
    /**
     * @return \FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider|\Spryker\Client\Search\Provider\IndexClientProvider
     */
    protected function createIndexProvider()
    {
        return new IndexClientProvider();
    }

    /**
     * @return \Spryker\Zed\Search\Business\Model\Elasticsearch\Generator\IndexMapGeneratorInterface
     */
    protected function createElasticsearchIndexMapGenerator()
    {
        return new IndexMapGenerator(
            $this->getConfig()->getClassTargetDirectory(),
            $this->getConfig()->getPermissionMode()
        );
    }
}
