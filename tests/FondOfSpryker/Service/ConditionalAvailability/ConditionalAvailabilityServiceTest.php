<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use Codeception\Test\Unit;
use DateTime;
use FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator\EarliestDeliveryDateGeneratorInterface;

class ConditionalAvailabilityServiceTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceFactory
     */
    protected $conditionalAvailabilityServiceFactoryMock;

    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator\EarliestDeliveryDateGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $earliestDeliveryDateGeneratorMock;

    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityService
     */
    protected $conditionalAvailabilityService;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityServiceFactoryMock = $this->getMockBuilder(ConditionalAvailabilityServiceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->earliestDeliveryDateGeneratorMock = $this->getMockBuilder(EarliestDeliveryDateGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityService = new ConditionalAvailabilityService();
        $this->conditionalAvailabilityService->setFactory($this->conditionalAvailabilityServiceFactoryMock);
    }

    /**
     * @return void
     */
    public function testGenerateEarliestDeliveryDate(): void
    {
        $dateTime = new DateTime();

        $this->conditionalAvailabilityServiceFactoryMock->expects(static::atLeastOnce())
            ->method('createEarliestDeliveryDateGenerator')
            ->willReturn($this->earliestDeliveryDateGeneratorMock);

        $this->earliestDeliveryDateGeneratorMock->expects(static::atLeastOnce())
            ->method('generate')
            ->willReturn($dateTime);

        static::assertEquals(
            $dateTime,
            $this->conditionalAvailabilityService->generateEarliestDeliveryDate()
        );
    }
}
