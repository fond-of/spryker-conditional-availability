<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Dependency\Plugin;

use DateTimeInterface;

interface SearchRangeSetterInterface
{
    /**
     * @param \DateTimeInterface $dateTimeFrom
     * @param \DateTimeInterface $dateTimeUntil
     *
     * @return void
     */
    public function setSearchDateTimeRange(DateTimeInterface $dateTimeFrom, DateTimeInterface $dateTimeUntil): void;
}
