<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use DateTime;
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

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \DateTime $dateTime
     *
     * @return \DateTimeInterface
     */
    public function generateEarliestDeliveryDateByDateTime(DateTime $dateTime): DateTimeInterface
    {
        return $this->getFactory()->createEarliestDeliveryDateGenerator()->generateByDateTime($dateTime);
    }
}
