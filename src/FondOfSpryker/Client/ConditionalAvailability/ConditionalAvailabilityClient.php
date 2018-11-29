<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use Elastica\ResultSet;
use Spryker\Client\Search\SearchClient;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class ConditionalAvailabilityClient extends SearchClient implements ConditionalAvailabilityClientInterface
{
    /**
     * @param string $searchString
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySearch($searchString): ResultSet
    {
        $searchQuery = $this->getFactory()->createConditionalAvailabilitySearchQuery($searchString);
        return $this->search($searchQuery);
    }
}
