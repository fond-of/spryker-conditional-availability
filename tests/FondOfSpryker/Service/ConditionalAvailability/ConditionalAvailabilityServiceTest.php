<?php

namespace FondOfSpryker\Service\ConditionalAvailability;

use Codeception\Test\Unit;
use DateTime;

class ConditionalAvailabilityServiceTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceFactory
     */
    protected $conditionalAvailabilityServiceFactoryMock;

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

        $this->conditionalAvailabilityService = new ConditionalAvailabilityService();
        $this->conditionalAvailabilityService->setFactory($this->conditionalAvailabilityServiceFactoryMock);
    }

    /**
     * @return void
     */
    public function testGenerateEarliestDeliveryDate(): void
    {
        $this->assertInstanceOf(DateTime::class, $this->conditionalAvailabilityService->generateEarliestDeliveryDate());
    }
}
