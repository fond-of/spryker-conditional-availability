<?php

namespace FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator;

use DateInterval;
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
        $earliestDeliveryDate = new DateTime();
        $earliestDeliveryDate->setTime(0, 0);

        $weekDay = (int)$earliestDeliveryDate->format('N');
        $deliveryDaysByWeekDay = $this->getDeliveryDaysByWeekDay($weekDay);

        $earliestDeliveryDate->add(new DateInterval(sprintf('P%dD', $deliveryDaysByWeekDay)));

        return $earliestDeliveryDate;
    }

    /**
     * @param int $weekDay
     *
     * @return int
     */
    protected function getDeliveryDaysByWeekDay(int $weekDay): int
    {
        $defaultDeliveryDays = $this->config->getDefaultDeliveryDays();

        switch ($weekDay) {
            case 5:
                return $defaultDeliveryDays + 2;
            case 6:
                return $defaultDeliveryDays + 1;
            default:
                return $defaultDeliveryDays;
        }
    }
}
