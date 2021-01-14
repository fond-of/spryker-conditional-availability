<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use DateTimeInterface;

interface ConditionalAvailabilityServiceInterface
{
    /**
     * Specification:
     * - Generate earliest delivery date as DateTime
     *
     * @api
     *
     * @return \DateTimeInterface
     */
    public function generateEarliestDeliveryDate(): DateTimeInterface;
}
