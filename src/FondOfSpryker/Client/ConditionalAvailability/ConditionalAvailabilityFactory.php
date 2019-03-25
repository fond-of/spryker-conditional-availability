<?php

declare(strict_types=1);

namespace FondOfSpryker\Client\ConditionalAvailability;

use DateTimeInterface;
use FondOfSpryker\Client\ConditionalAvailability\Dependency\Plugin\SearchRangeSetterInterface;
use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;
use FondOfSpryker\Client\Search\SearchFactory;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringSetterInterface;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 */
class ConditionalAvailabilityFactory extends SearchFactory
{
    /**
     * @return \FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider
     */
    protected function createIndexClientProvider(): IndexClientProvider
    {
        return new IndexClientProvider();
    }

    /**
     * @return \Generated\Shared\ConditionalAvailability\Search\PageIndexMap
     */
    protected function createPageIndexMap(): PageIndexMap
    {
        return new PageIndexMap();
    }

    /**
     * @param string|null $searchString
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function createConditionalAvailabilitySkuSearchQuery(?string $searchString): QueryInterface
    {
        $searchQuery = $this->getConditionalAvailabilitySkuSearchQueryPlugin();
        if ($searchQuery instanceof SearchStringSetterInterface) {
            $searchQuery->setSearchString($searchString);
        }

        return $searchQuery;
    }

    /**
     * @param \DateTimeInterface $dateTimeFrom
     * @param \DateTimeInterface $dateTimeUntil
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function createConditionalAvailabilityPingSearchQuery(DateTimeInterface $dateTimeFrom, DateTimeInterface $dateTimeUntil): QueryInterface
    {
        $searchQuery = $this->getConditionalAvailabilityPingSearchQueryPlugin();
        if ($searchQuery instanceof SearchRangeSetterInterface) {
            $searchQuery->setSearchDateTimeRange($dateTimeFrom, $dateTimeUntil);
        }

        return $searchQuery;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function getConditionalAvailabilitySkuSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_PLUGIN);
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getConditionalAvailabilitySkuSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_EXPANDER_PLUGINS);
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getConditionalAvailabilitySkuSearchQueryFormatterPlugins(): array
    {
        return $this->getProvidedDependency(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_FORMATTER_PLUGINS);
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function getConditionalAvailabilityPingSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_PLUGIN);
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getConditionalAvailabilityPingSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_EXPANDER_PLUGINS);
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getConditionalAvailabilityPingSearchQueryFormatterPlugins(): array
    {
        return $this->getProvidedDependency(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_FORMATTER_PLUGINS);
    }
}
