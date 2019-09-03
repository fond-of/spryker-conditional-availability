<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use Codeception\Test\Unit;
use FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator\EarliestDeliveryDateGenerator;

class ConditionalAvailabilityServiceFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceFactory
     */
    protected $conditionalAvailabilityServiceFactory;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->conditionalAvailabilityServiceFactory = new ConditionalAvailabilityServiceFactory();
    }

    /**
     * @return void
     */
    public function testCreateEarliestDeliveryDateGenerator(): void
    {
        $this->assertInstanceOf(EarliestDeliveryDateGenerator::class, $this->conditionalAvailabilityServiceFactory->createEarliestDeliveryDateGenerator());
    }
}
