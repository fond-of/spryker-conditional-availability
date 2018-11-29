<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use Elastica\ResultSet;

interface ConditionalAvailabilityClientInterface
{
    /**
     * @param string $searchString
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySearch($searchString): ResultSet;
}
