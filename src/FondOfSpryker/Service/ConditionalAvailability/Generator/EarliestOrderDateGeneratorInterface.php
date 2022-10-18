<?php

namespace FondOfSpryker\Service\ConditionalAvailability\Generator;

use DateTimeInterface;

interface EarliestOrderDateGeneratorInterface
{
    /**
     * @return \DateTimeInterface
     */
    public function generate(): DateTimeInterface;
}
