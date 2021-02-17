<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use DateTime;
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

    /**
     * Specification:
     * - Generate earliest delivery date by given date time as DateTime
     *
     * @api
     *
     * @param \DateTime $dateTime
     *
     * @return \DateTimeInterface
     */
    public function generateEarliestDeliveryDateByDateTime(DateTime $dateTime): DateTimeInterface;
}
