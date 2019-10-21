<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Elastica\Query;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class MaxSizeConditionalAvailabilityQueryPluginExpander extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param mixed[] $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        $this->setMaxSizeToQuery($searchQuery->getSearchQuery(), 10000);

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $query
     * @param int $size
     *
     * @return void
     */
    protected function setMaxSizeToQuery(Query $query, int $size): void
    {
        $query->setSize($size);
    }
}
