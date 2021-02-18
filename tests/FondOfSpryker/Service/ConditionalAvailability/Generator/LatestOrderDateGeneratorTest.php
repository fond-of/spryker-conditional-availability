<?php

namespace FondOfSpryker\Service\ConditionalAvailability\Generator;

use Codeception\Test\Unit;
use DateTime;
use FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;

class LatestOrderDateGeneratorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\Generator\LatestOrderDateGenerator
     */
    protected $latestOrderDateGenerator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ConditionalAvailabilityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->latestOrderDateGenerator = new LatestOrderDateGenerator(
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testGenerateByDeliveryDate(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getDefaultDeliveryDays')
            ->willReturn(ConditionalAvailabilityConstants::DEFAULT_VALUE_DEFAULT_DELIVERY_DAYS);

        static::assertEquals(
            new DateTime('2021-02-12'),
            $this->latestOrderDateGenerator->generateByDeliveryDate(new DateTime('2021-02-16'))
        );
    }
}
