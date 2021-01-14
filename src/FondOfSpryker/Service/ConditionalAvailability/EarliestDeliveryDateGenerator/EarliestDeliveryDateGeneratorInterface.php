<?php

namespace FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator;

use DateTimeInterface;

interface EarliestDeliveryDateGeneratorInterface
{
    /**
     * @return \DateTimeInterface
     */
    public function generate(): DateTimeInterface;
}
