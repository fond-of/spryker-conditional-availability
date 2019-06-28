<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class WarehouseConditionalAvailabilityQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if ($this->hasWarehouseValue($requestParameters)) {
            $this->addWarehouseToQuery($searchQuery->getSearchQuery(), $this->getWarehouseValueFrom($requestParameters));
        }

        return $searchQuery;
    }

    /**
     * @param mixed[] $requestParameters
     *
     * @return string
     */
    protected function getWarehouseValueFrom(array $requestParameters): string
    {
        return $requestParameters[ConditionalAvailabilityConstants::PARAMETER_WAREHOUSE];
    }

    /**
     * @param mixed[] $requestParameters
     *
     * @return bool
     */
    protected function hasWarehouseValue(array $requestParameters): bool
    {
        return array_key_exists(ConditionalAvailabilityConstants::PARAMETER_WAREHOUSE, $requestParameters);
    }

    /**
     * @param \Elastica\Query $query
     * @param string $warehouse
     *
     * @return void
     */
    protected function addWarehouseToQuery(Query $query, string $warehouse): void
    {
        $this->getBoolQuery($query)->addMust(
            $this->getFactory()->createQueryBuilder()->createTermQuery(PageIndexMap::WAREHOUSEGROUP, $warehouse)
        );
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();
        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(sprintf(
                'Localized query expander available only with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery)
            ));
        }

        return $boolQuery;
    }
}
