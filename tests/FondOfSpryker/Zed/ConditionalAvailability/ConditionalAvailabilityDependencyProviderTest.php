<?php

namespace FondOfSpryker\Client\Zed\ConditionalAvailability;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ConditionalAvailabilityDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityDependencyProvider
     */
    protected $conditionalAvailabilityDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before()
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
    public function testProvideBusinessLayerDependencies(): void
    {

        $this->assertInstanceOf(Container::class, $this->conditionalAvailabilityDependencyProvider->provideBusinessLayerDependencies($this->containerMock));
    }
}
