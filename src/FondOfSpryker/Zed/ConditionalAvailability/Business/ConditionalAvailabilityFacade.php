<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;

use Elastica\ResultSet;
use Spryker\Zed\Search\Business\SearchFacade;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityBusinessFactory getFactory()
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface getClient()
 */
class ConditionalAvailabilityFacade extends SearchFacade implements ConditionalAvailabilityFacadeInterface
{
    /**
     * @param string|null $searchString
     * @param string[] $requestParameters
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySkuSearch(?string $searchString, array $requestParameters = []): ResultSet
    {
         return $this->getClient()->conditionalAvailabilitySkuSearch($searchString, $requestParameters);
    }

    /**
     * @return bool
     */
    public function hasConditionalAvailabilityPingsInLastHour(): bool
    {
        $dateTimeFrom = new \DateTimeImmutable();
        $dateTimeUntil = $dateTimeFrom->modify('-1 hour');

        $result = $this->getClient()->ConditionalAvailabilityLastPingSearch($dateTimeFrom, $dateTimeUntil);

        return $result->getTotalHits() > 0;
    }
}
