<?php

namespace FondOfSpryker\Service\ConditionalAvailability\Generator;

use DateTime;
use DateTimeInterface;

interface EarliestDeliveryDateGeneratorInterface
{
    /**
     * @return \DateTimeInterface
     */
    public function generate(): DateTimeInterface;

    /**
     * @param \DateTime $dateTime
     *
     * @return \DateTimeInterface
     */
    public function generateByDateTime(DateTime $dateTime): DateTimeInterface;
}
