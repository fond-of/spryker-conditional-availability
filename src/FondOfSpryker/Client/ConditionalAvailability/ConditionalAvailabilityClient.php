<?php

declare(strict_types=1);

namespace FondOfSpryker\Client\ConditionalAvailability;

use DateTimeInterface;
use Elastica\ResultSet;
use Spryker\Client\Search\SearchClient;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class ConditionalAvailabilityClient extends SearchClient implements ConditionalAvailabilityClientInterface
{
    /**
     * @param string|null $searchString
     * @param string[] $requestParameters
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySkuSearch(?string $searchString, array $requestParameters = []): ResultSet
    {
        $searchQuery = $this->getFactory()->createConditionalAvailabilitySkuSearchQuery($searchString);
        $searchQuery = $this->expandQuery($searchQuery, $this->getFactory()->getConditionalAvailabilitySkuSearchQueryExpanderPlugins(), $requestParameters);
        $resultFormatters = $this->getFactory()->getConditionalAvailabilitySkuSearchQueryFormatterPlugins();

        return $this->search($searchQuery, $resultFormatters, $requestParameters);
    }

    /**
     * @param \DateTimeInterface $dateTimeFrom
     * @param \DateTimeInterface $dateTimeUntil
     * @param string[] $requestParameters
     *
     * @return \Elastica\ResultSet
     */
    public function ConditionalAvailabilityLastPingSearch(DateTimeInterface $dateTimeFrom, DateTimeInterface $dateTimeUntil, array $requestParameters = []): ResultSet
    {
        $searchQuery = $this->getFactory()->createConditionalAvailabilityPingSearchQuery($dateTimeFrom, $dateTimeUntil);
        $searchQuery = $this->expandQuery($searchQuery, $this->getFactory()->getConditionalAvailabilityPingSearchQueryExpanderPlugins(), $requestParameters);
        $resultFormatters = $this->getFactory()->getConditionalAvailabilityPingSearchQueryFormatterPlugins();

        return $this->search($searchQuery, $resultFormatters, $requestParameters);
    }
}
