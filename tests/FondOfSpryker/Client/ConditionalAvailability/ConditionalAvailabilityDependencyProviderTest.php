<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class ConditionalAvailabilityDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityDependencyProvider
     */
    protected $conditionalAvailabilityDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityDependencyProvider = new ConditionalAvailabilityDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->assertInstanceOf(Container::class, $this->conditionalAvailabilityDependencyProvider->provideServiceLayerDependencies($this->containerMock));
    }
}
