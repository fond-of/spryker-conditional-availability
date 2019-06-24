<?php

namespace FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator;

use DateTime;

interface EarliestDeliveryDateGeneratorInterface
{
    /**
     * @return \DateTime
     */
    public function generate(): DateTime;
}
