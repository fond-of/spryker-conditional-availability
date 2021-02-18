<?php

namespace FondOfSpryker\Service\ConditionalAvailability\Generator;

use DateTime;
use DateTimeInterface;

interface LatestOrderDateGeneratorInterface
{
    /**
     * @param \DateTime $deliveryDate
     *
     * @return \DateTimeInterface
     */
    public function generateByDeliveryDate(DateTime $deliveryDate): DateTimeInterface;
}
