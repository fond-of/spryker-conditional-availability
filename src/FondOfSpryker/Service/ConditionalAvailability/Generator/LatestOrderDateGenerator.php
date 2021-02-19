<?php

namespace FondOfSpryker\Service\ConditionalAvailability\Generator;

use DateTime;
use DateTimeInterface;
use FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig;

class LatestOrderDateGenerator implements LatestOrderDateGeneratorInterface
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
     * @param \DateTime $deliveryDate
     *
     * @return \DateTimeInterface
     */
    public function generateByDeliveryDate(DateTime $deliveryDate): DateTimeInterface
    {
        $defaultDeliveryDays = $this->config->getDefaultDeliveryDays();

        $latestOrderDate = clone $deliveryDate;
        $latestOrderDate->setTime(0, 0);

        while ($defaultDeliveryDays > 0) {
            $latestOrderDate->modify('-1day');
            $weekDay = (int)$latestOrderDate->format('N');

            if ($weekDay === 6 || $weekDay === 7) {
                continue;
            }

            $defaultDeliveryDays--;
        }

        return $latestOrderDate;
    }
}
