<?php

namespace FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator;

use Codeception\Test\Unit;
use DateTime;
use FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;

class EarliestDeliveryDateGeneratorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator\EarliestDeliveryDateGenerator
     */
    protected $earliestDeliveryDateGenerator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ConditionalAvailabilityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->earliestDeliveryDateGenerator = new EarliestDeliveryDateGenerator(
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getDefaultDeliveryDays')
            ->willReturn(ConditionalAvailabilityConstants::DEFAULT_VALUE_DEFAULT_DELIVERY_DAYS);

        static::assertInstanceOf(
            DateTime::class,
            $this->earliestDeliveryDateGenerator->generate()
        );
    }
}
