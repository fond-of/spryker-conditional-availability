<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use DateTime;
use Elastica\ResultSet;
use Spryker\Client\Search\SearchClientInterface;

interface ConditionalAvailabilityClientInterface extends SearchClientInterface
{
    /**
     * Conditional availability search
     *
     * @param string $sku
     * @param \DateTime $date
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySearch(string $sku, DateTime $date): ResultSet;

    /**
     * @param string $warehousegroup
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySearchWarehouse(string $warehousegroup): ResultSet;
}
