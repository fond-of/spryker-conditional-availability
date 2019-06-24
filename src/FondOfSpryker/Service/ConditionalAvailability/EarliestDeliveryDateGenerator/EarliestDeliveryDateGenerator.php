<?php

namespace FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator;

use DateInterval;
use DateTime;

class EarliestDeliveryDateGenerator implements EarliestDeliveryDateGeneratorInterface
{
    protected const DEFAULT_DELIVERY_DAYS = 2;

    /**
     * @throws
     *
     * @return \DateTime
     */
    public function generate(): DateTime
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
        switch ($weekDay) {
            case 5:
                return static::DEFAULT_DELIVERY_DAYS + 2;
            case 6:
                return static::DEFAULT_DELIVERY_DAYS + 1;
            default:
                return static::DEFAULT_DELIVERY_DAYS;
        }
    }
}
