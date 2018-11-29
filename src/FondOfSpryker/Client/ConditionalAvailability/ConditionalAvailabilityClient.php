<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use DateTime;
use Elastica\ResultSet;
use Spryker\Client\Search\SearchClient;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class ConditionalAvailabilityClient extends SearchClient implements ConditionalAvailabilityClientInterface
{
    /**
     * @param string $sku
     * @param \DateTime $date
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySearch(string $sku, DateTime $date): ResultSet
    {
        $searchQuery = $this->getFactory()->createConditionalAvailabilitySearchQuery($sku, $date);
        return $this->search($searchQuery);
    }

    /**
     * @param string $warehousegroup
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySearchWarehouse(string $warehousegroup): ResultSet
    {
        $searchQuery = $this->getFactory()->createConditionalAvailabilitySearchQueryWarehouse($warehousegroup);

        /*
        $this->getSearchConfig()->getPaginationConfigBuilder()->setPagination(
            (new PaginationConfigTransfer())->setDefaultItemsPerPage(100)
        );*/

        return $this->search($searchQuery);
    }
}
