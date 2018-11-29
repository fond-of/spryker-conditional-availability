<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchAll;
use Elastica\Query\MultiMatch;

use FondOfSpryker\Client\ConditionalAvailability\Dependency\Plugin\WarehouseStringSetterInterface;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringGetterInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringSetterInterface;

class ConditionalAvailabilitySearchQueryPlugin extends AbstractPlugin implements QueryInterface, SearchStringSetterInterface, SearchStringGetterInterface, WarehouseStringSetterInterface
{
    /**
     * @var string
     */
    protected $searchString;

    /**
     * @var string
     */
    protected $warehouseString;

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
    public function getSearchQuery()
    {
        return $this->query;
    }

    /**
     * @param string $searchString
     *
     * @return void
     */
    public function setSearchString($searchString)
    {
        $this->searchString = $searchString;
        $this->query = $this->createSearchQuery();
    }

    /**
     * @return string
     */
    public function getSearchString()
    {
        return $this->searchString;
    }

    /**
     * @return \Elastica\Query
     */
    protected function createSearchQuery()
    {
        $query = new Query();

        if (!empty($this->searchString)) {
            $fields = [PageIndexMap::SKU];

            $matchQuery = (new MultiMatch())
                ->setFields($fields)
                ->setQuery($this->searchString)
                ->setType(MultiMatch::TYPE_CROSS_FIELDS);
        } else {
            $matchQuery = new MatchAll();
        }

        $boolQuery = new BoolQuery();
        $boolQuery->addMust($matchQuery);
        $query->setQuery($boolQuery);

        return $query;
    }

    /**
     * @api
     *
     * @param string $warehouse
     *
     * @return void
     */
    public function setWarehouseString(string $warehouse)
    {
        $this->warehouseString = $warehouse;
        $this->query = $this->createWarehouseQuery();
    }

    /**
     * @return \Elastica\Query
     */
    protected function createWarehouseQuery()
    {
        $query = new Query();

        if (!empty($this->warehouseString)) {
            $fields = [PageIndexMap::WAREHOUSEGROUP];

            $matchQuery = (new MultiMatch())
                ->setFields($fields)
                ->setQuery($this->warehouseString)
                ->setType(MultiMatch::TYPE_CROSS_FIELDS);
        } else {
            $matchQuery = new MatchAll();
        }

        $boolQuery = new BoolQuery();
        $boolQuery->addMust($matchQuery);
        $query->setQuery($boolQuery);

        return $query;
    }
}
