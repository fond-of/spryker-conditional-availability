<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class SortedConditionalAvailabilityQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * Specification:
     *  - Expands base query
     *
     * @api
     *
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if (!$this->hasSort($requestParameters)) {
            return $searchQuery;
        }

        $this->addSortParamsToQuery(
            $searchQuery->getSearchQuery(),
            $requestParameters
        );

        return $searchQuery;
    }

    /**
     * @param mixed[] $requestParameters
     *
     * @return bool
     */
    protected function hasSort(array $requestParameters): bool
    {
        return array_key_exists(ConditionalAvailabilityConstants::PARAMETER_SORT, $requestParameters);
    }

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function addSortParamsToQuery(QueryInterface $searchQuery, array $requestParameters): QueryInterface
    {
        /** @var \Elastica\Query $query */
        $query = $searchQuery->getSearchQuery();

        foreach ($requestParameters['sort'] as $field => $order) {
            $query->addSort(
                [
                    $field => [
                        'order' => $order,
                    ],
                ]
            );
        }

        return $searchQuery;
    }
}
