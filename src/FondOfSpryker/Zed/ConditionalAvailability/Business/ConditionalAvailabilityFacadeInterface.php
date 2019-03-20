<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;

use Elastica\ResultSet;
use \Spryker\Zed\Search\Business\SearchFacadeInterface as SprykerSearchFacadeInterface;

interface ConditionalAvailabilityFacadeInterface extends SprykerSearchFacadeInterface
{
    /**
     * @param string|null $searchString
     * @param string[] $requestParameters
     *
     * @return \Elastica\ResultSet
     */
    public function conditionalAvailabilitySkuSearch(?string $searchString, array $requestParameters = []): ResultSet;

    /**
     * @return bool
     */
    public function hasConditionalAvailabilityPingsInLastHour(): bool;
}
