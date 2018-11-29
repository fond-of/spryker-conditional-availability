<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use Elastica\ResultSet;
use Spryker\Client\Search\SearchClientInterface;

interface ConditionalAvailabilityClientInterface extends SearchClientInterface
{
    /**
     * @param string $searchString
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySearch($searchString): ResultSet;
}
