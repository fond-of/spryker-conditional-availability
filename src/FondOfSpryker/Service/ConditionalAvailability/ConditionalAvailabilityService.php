<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use DateTimeInterface;
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceFactory getFactory()
 */
class ConditionalAvailabilityService extends AbstractService implements ConditionalAvailabilityServiceInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \DateTimeInterface
     */
    public function generateEarliestDeliveryDate(): DateTimeInterface
    {
        return $this->getFactory()->createEarliestDeliveryDateGenerator()->generate();
    }
}
