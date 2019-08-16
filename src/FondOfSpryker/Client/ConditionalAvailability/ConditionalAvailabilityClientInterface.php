<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\ConditionalAvailability;

use DateTimeInterface;
use Spryker\Client\Search\SearchClientInterface;

interface ConditionalAvailabilityClientInterface extends SearchClientInterface
{
    /**
     * @param string|null $searchString
     * @param string[] $requestParameters
     *
     * @return array
     */
    public function conditionalAvailabilitySkuSearch(?string $searchString, array $requestParameters = []): array;

    /**
     * @param \DateTimeInterface $dateTimeFrom
     * @param \DateTimeInterface $dateTimeUntil
     * @param string[] $requestParameters
     *
     * @return array
     */
    public function conditionalAvailabilityLastPingSearch(DateTimeInterface $dateTimeFrom, DateTimeInterface $dateTimeUntil, array $requestParameters = []): array;
}
