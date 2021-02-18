<?php

namespace FondOfSpryker\Service\ConditionalAvailability\Generator;

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
     * @codeCoverageIgnore
     *
     * @return \DateTimeInterface
     */
    public function generate(): DateTimeInterface
    {
        return $this->generateByDateTime(new DateTime());
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return \DateTimeInterface
     */
    public function generateByDateTime(DateTime $dateTime): DateTimeInterface
    {
        $defaultDeliveryDays = $this->config->getDefaultDeliveryDays();

        $dateTime->setTime(0, 0);

        while ($defaultDeliveryDays > 0) {
            $dateTime->modify('+1day');
            $weekDay = (int)$dateTime->format('N');

            if ($weekDay === 6 || $weekDay === 7) {
                continue;
            }

            $defaultDeliveryDays--;
        }

        return $dateTime;
    }
}
