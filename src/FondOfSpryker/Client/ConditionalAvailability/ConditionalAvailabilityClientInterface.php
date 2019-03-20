<?php

declare(strict_types=1);

namespace FondOfSpryker\Client\ConditionalAvailability;

use DateTimeInterface;
use Elastica\ResultSet;
use Spryker\Client\Search\SearchClientInterface;

interface ConditionalAvailabilityClientInterface extends SearchClientInterface
{
    /**
     * @param string|null $searchString
     * @param string[] $requestParameters
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySkuSearch(?string $searchString, array $requestParameters = []): ResultSet;

    /**
     * @param \DateTimeInterface $dateTimeFrom
     * @param \DateTimeInterface $dateTimeUntil
     * @param string[] $requestParameters
     *
     * @return \Elastica\ResultSet
     */
    public function ConditionalAvailabilityLastPingSearch(DateTimeInterface $dateTimeFrom, DateTimeInterface $dateTimeUntil, array $requestParameters = []): ResultSet;
}
