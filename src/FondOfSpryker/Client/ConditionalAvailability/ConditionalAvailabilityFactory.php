<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

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
     * @param string $searchString
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function createConditionalAvailabilitySearchQuery($searchString): QueryInterface
    {
        $searchQuery = $this->getConditionalAvailabilitySearchQueryPlugin();

        if ($searchQuery instanceof SearchStringSetterInterface) {
            $searchQuery->setSearchString($searchString);
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
     * @return \Generated\Shared\ConditionalAvailability\Search\PageIndexMap
     */
    protected function createPageIndexMap()
    {
        return new PageIndexMap();
    }
}
