<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use DateTime;

interface ConditionalAvailabilityServiceInterface
{
    /**
     * Specification:
     * - Generate earliest delivery date as DateTime
     *
     * @api
     *
     * @return \DateTime
     */
    public function generateEarliestDeliveryDate(): DateTime;
}
