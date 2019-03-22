<?php

declare(strict_types=1);

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query;

use DateTimeInterface;
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
class ConditionalAvailabilityDateQueryExpander extends AbstractPlugin implements QueryExpanderPluginInterface
{
    protected const DATE_FORMAT_PARAMETER = 'format';
    protected const DATE_FORMAT_VALUE = 'yyyy-MM-dd HH:mm:ss';
    protected const REQUEST_PARAMETER_DATE = 'date';

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param mixed[] $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = [])
    {
        if ($this->hasDate($requestParameters)) {
            $this->addDateFilterToQuery($searchQuery->getSearchQuery(), $this->getDateFrom($requestParameters));
        }

        return $searchQuery;
    }

    /**
     * @param mixed[] $requestParameters
     *
     * @return \DateTimeInterface
     */
    protected function getDateFrom(array $requestParameters): DateTimeInterface
    {
        return $requestParameters[ConditionalAvailabilityConstants::PARAMETER_DATE];
    }

    /**
     * @param mixed[] $requestParameters
     *
     * @return bool
     */
    protected function hasDate(array $requestParameters): bool
    {
        return \array_key_exists(ConditionalAvailabilityConstants::PARAMETER_DATE, $requestParameters);
    }

    /**
     * @param \Elastica\Query $query
     * @param \DateTimeInterface $dateTime
     *
     * @return void
     */
    protected function addDateFilterToQuery(Query $query, DateTimeInterface $dateTime): void
    {
        $boolQuery = $this->getBoolQuery($query);

        $formattedDate = $dateTime->format('Y-m-d H:i:s');

        $rangeStart = $this->getFactory()->createQueryBuilder()->createRangeQuery(PageIndexMap::STARTAT, null, $formattedDate);
        $boolQuery->addFilter($rangeStart);

        $rangeEnd = $this->getFactory()->createQueryBuilder()->createRangeQuery(PageIndexMap::ENDAT, $formattedDate, null);
        $boolQuery->addFilter($rangeEnd);
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
