<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Spryker\Service\Kernel\AbstractBundleConfig;

class ConditionalAvailabilityConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getDefaultDeliveryDays(): int
    {
        return $this->get(
            ConditionalAvailabilityConstants::DEFAULT_DELIVERY_DAYS,
            ConditionalAvailabilityConstants::DEFAULT_VALUE_DEFAULT_DELIVERY_DAYS,
        );
    }
}
