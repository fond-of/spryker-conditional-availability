<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query;

use DateTimeInterface;
use Elastica\Query;
use FondOfSpryker\Client\ConditionalAvailability\Dependency\Plugin\SearchRangeGetterInterface;
use FondOfSpryker\Client\ConditionalAvailability\Dependency\Plugin\SearchRangeSetterInterface;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class ConditionalAvailabilityPingSearchQueryPlugin extends AbstractPlugin implements QueryInterface, SearchRangeGetterInterface, SearchRangeSetterInterface
{
    protected const FORMAT = 'Y-m-d H:i:s';
    protected const TYPE_FIELD = '_type';
    protected const TYPE_VALUE = 'ping';

    /**
     * @var \DateTimeInterface|null
     */
    protected $dateTimeFrom;

    /**
     * @var \DateTimeInterface|null
     */
    protected $dateTimeUntil;

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
     * @return \DateTimeInterface|null
     */
    public function getSearchDateTimeFrom(): ?DateTimeInterface
    {
        return $this->dateTimeFrom;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getSearchDateTimeUntil(): ?DateTimeInterface
    {
        return $this->dateTimeUntil;
    }

    /**
     * @param \DateTimeInterface $dateTimeFrom
     * @param \DateTimeInterface $dateTimeUntil
     *
     * @return void
     */
    public function setSearchDateTimeRange(DateTimeInterface $dateTimeFrom, DateTimeInterface $dateTimeUntil): void
    {
        $this->dateTimeFrom = $dateTimeFrom;
        $this->dateTimeUntil = $dateTimeUntil;
        $this->query = $this->createSearchQuery();
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

        if ($this->getSearchDateTimeFrom() === null || $this->getSearchDateTimeUntil() === null) {
            return new Query($boolQuery);
        }

        $rangeQuery = $queryBuilder->createRangeQuery(
            PageIndexMap::LASTUPDATEAT,
            $this->getSearchDateTimeFrom()->format(static::FORMAT),
            $this->getSearchDateTimeUntil()->format(static::FORMAT)
        );

        $boolQuery->addMust($rangeQuery);

        return new Query($boolQuery);
    }
}
