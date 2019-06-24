<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use DateTime;
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceFactory getFactory()
 */
class ConditionalAvailabilityService extends AbstractService implements ConditionalAvailabilityServiceInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return \DateTime
     */
    public function generateEarliestDeliveryDate(): DateTime
    {
        return $this->getFactory()->createEarliestDeliveryDateGenerator()->generate();
    }
}
