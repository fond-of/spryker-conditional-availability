<?php

namespace FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator;

use DateTime;
use DateTimeInterface;
use FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig;

class EarliestDeliveryDateGenerator implements EarliestDeliveryDateGeneratorInterface
{
    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig $config
     */
    public function __construct(ConditionalAvailabilityConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return \DateTimeInterface
     */
    public function generate(): DateTimeInterface
    {
        $defaultDeliveryDays = $this->config->getDefaultDeliveryDays();

        $earliestDeliveryDate = new DateTime();
        $earliestDeliveryDate->setTime(0, 0);

        while ($defaultDeliveryDays > 0) {
            $earliestDeliveryDate->modify('+1day');
            $weekDay = (int)$earliestDeliveryDate->format('N');

            if ($weekDay === 6 || $weekDay === 7) {
                continue;
            }

            $defaultDeliveryDays--;
        }

        return $earliestDeliveryDate;
    }
}
