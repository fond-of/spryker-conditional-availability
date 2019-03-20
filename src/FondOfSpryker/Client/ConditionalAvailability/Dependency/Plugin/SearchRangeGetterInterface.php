<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Dependency\Plugin;

use DateTimeInterface;

interface SearchRangeGetterInterface
{
    /**
     * @return \DateTimeInterface|null
     */
    public function getSearchDateTimeFrom(): ?DateTimeInterface;

    /**
     * @return \DateTimeInterface|null
     */
    public function getSearchDateTimeUntil(): ?DateTimeInterface;
}
