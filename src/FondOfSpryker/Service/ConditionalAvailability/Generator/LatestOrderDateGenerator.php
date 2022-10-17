<?php

namespace FondOfSpryker\Service\ConditionalAvailability\Generator;

use DateTime;
use DateTimeInterface;
use FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig;

class LatestOrderDateGenerator implements LatestOrderDateGeneratorInterface
{
    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\Generator\EarliestOrderDateGeneratorInterface
     */
    protected $earliestOrderDateGenerator;

    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Service\ConditionalAvailability\Generator\EarliestOrderDateGeneratorInterface $earliestOrderDateGenerator
     * @param \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig $config
     */
    public function __construct(
        EarliestOrderDateGeneratorInterface $earliestOrderDateGenerator,
        ConditionalAvailabilityConfig $config
    ) {
        $this->earliestOrderDateGenerator = $earliestOrderDateGenerator;
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

        return max($latestOrderDate, $this->earliestOrderDateGenerator->generate());
    }
}
