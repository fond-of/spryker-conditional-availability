<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use Codeception\Test\Unit;
use FondOfSpryker\Service\ConditionalAvailability\Generator\EarliestDeliveryDateGenerator;
use FondOfSpryker\Service\ConditionalAvailability\Generator\LatestOrderDateGenerator;

class ConditionalAvailabilityServiceFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

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

        $this->configMock = $this->getMockBuilder(ConditionalAvailabilityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityServiceFactory = new ConditionalAvailabilityServiceFactory();
        $this->conditionalAvailabilityServiceFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateEarliestDeliveryDateGenerator(): void
    {
        static::assertInstanceOf(
            EarliestDeliveryDateGenerator::class,
            $this->conditionalAvailabilityServiceFactory->createEarliestDeliveryDateGenerator(),
        );
    }

    /**
     * @return void
     */
    public function testCreateLatestOrderDateGenerator(): void
    {
        static::assertInstanceOf(
            LatestOrderDateGenerator::class,
            $this->conditionalAvailabilityServiceFactory->createLatestOrderDateGenerator(),
        );
    }
}
