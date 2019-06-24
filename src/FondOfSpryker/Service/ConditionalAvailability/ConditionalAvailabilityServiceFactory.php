<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator\EarliestDeliveryDateGenerator;
use FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator\EarliestDeliveryDateGeneratorInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

class ConditionalAvailabilityServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator\EarliestDeliveryDateGeneratorInterface
     */
    public function createEarliestDeliveryDateGenerator(): EarliestDeliveryDateGeneratorInterface
    {
        return new EarliestDeliveryDateGenerator();
    }
}
