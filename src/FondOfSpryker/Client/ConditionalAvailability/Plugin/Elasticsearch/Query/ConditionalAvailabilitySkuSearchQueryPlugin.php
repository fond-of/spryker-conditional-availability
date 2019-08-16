<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringGetterInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringSetterInterface;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class ConditionalAvailabilitySkuSearchQueryPlugin extends AbstractPlugin implements QueryInterface, SearchStringSetterInterface, SearchStringGetterInterface
{
    protected const TYPE_FIELD = '_type';
    protected const TYPE_VALUE = 'period';

    /**
     * @var string|null
     */
    protected $searchString;

    /**
     * @var \Elastica\Query
     */
    protected $query;

    public function __construct()
    {
        $this->query = $this->createSearchQuery();
    }

    /**
     * @return \Elastica\Query
     */
    public function getSearchQuery(): Query
    {
        return $this->query;
    }

    /**
     * @param string|null $searchString
     *
     * @return void
     */
    public function setSearchString($searchString): void
    {
        $this->searchString = $searchString;
        $this->query = $this->createSearchQuery();
    }

    /**
     * @return string|null
     */
    public function getSearchString(): ?string
    {
        return $this->searchString;
    }

    /**
     * @return bool
     */
    protected function hasSearchString(): bool
    {
        return $this->searchString !== null;
    }

    /**
     * @return \Elastica\Query
     */
    protected function createSearchQuery(): Query
    {
        $queryBuilder = $this->getFactory()->createQueryBuilder();
        $boolQuery = $queryBuilder->createBoolQuery();
        $matchQuery = $queryBuilder->createMatchQuery()->setField(static::TYPE_FIELD, static::TYPE_VALUE);

        $boolQuery->addMust($matchQuery);

        if (!$this->hasSearchString()) {
            return new Query($boolQuery);
        }

        $matchQuery = $queryBuilder->createTermQuery(PageIndexMap::SKU, $this->searchString);

        $boolQuery->addMust($matchQuery);

        return new Query($boolQuery);
    }
}
