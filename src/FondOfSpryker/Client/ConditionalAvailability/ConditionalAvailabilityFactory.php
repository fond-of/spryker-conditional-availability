<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use DateTime;
use FondOfSpryker\Client\ConditionalAvailability\Dependency\Plugin\WarehouseStringSetterInterface;
use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringSetterInterface;
use Spryker\Client\Search\SearchFactory;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 */
class ConditionalAvailabilityFactory extends SearchFactory
{
    /**
     * @param string $sku
     * @param \DateTime $date
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function createConditionalAvailabilitySearchQuery(string $sku, DateTime $date): QueryInterface
    {
        $searchQuery = $this->getConditionalAvailabilitySearchQueryPlugin();

        if ($searchQuery instanceof SearchStringSetterInterface) {
            $searchQuery->setSearchString($sku);
        }

        return $searchQuery;
    }

    /**
     * @param string $warehouse
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function createConditionalAvailabilitySearchQueryWarehouse(string $warehouse): QueryInterface
    {
        $searchQuery = $this->getConditionalAvailabilitySearchQueryPlugin();

        if ($searchQuery instanceof WarehouseStringSetterInterface) {
            $searchQuery->setWarehouseString($warehouse);
        }
        return $searchQuery;
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function getConditionalAvailabilitySearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SEARCH_QUERY_PLUGIN);
    }

    /**
     * @return \FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider
     */
    protected function createIndexClientProvider()
    {
        return new IndexClientProvider();
    }

    /**
     * @return \Generated\Shared\ConditionalAvailability\Search\PageIndexMap
     */
    protected function createPageIndexMap()
    {
        return new PageIndexMap();
    }
}
