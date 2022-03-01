<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use FondOfSpryker\Service\ConditionalAvailability\Generator\EarliestDeliveryDateGenerator;
use FondOfSpryker\Service\ConditionalAvailability\Generator\EarliestDeliveryDateGeneratorInterface;
use FondOfSpryker\Service\ConditionalAvailability\Generator\LatestOrderDateGenerator;
use FondOfSpryker\Service\ConditionalAvailability\Generator\LatestOrderDateGeneratorInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

/**
 * @method \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 */
class ConditionalAvailabilityServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfSpryker\Service\ConditionalAvailability\Generator\EarliestDeliveryDateGeneratorInterface
     */
    public function createEarliestDeliveryDateGenerator(): EarliestDeliveryDateGeneratorInterface
    {
        return new EarliestDeliveryDateGenerator(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfSpryker\Service\ConditionalAvailability\Generator\LatestOrderDateGeneratorInterface
     */
    public function createLatestOrderDateGenerator(): LatestOrderDateGeneratorInterface
    {
        return new LatestOrderDateGenerator(
            $this->getConfig(),
        );
    }
}
