<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaginationConfigTransfer;

class ConditionalAvailabilityConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $conditionalAvailabilityConfig;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityConfig = new ConditionalAvailabilityConfig();
    }

    /**
     * @return void
     */
    public function testGetConditionalAvailabilityPaginationConfigTransfer(): void
    {
        $this->assertInstanceOf(PaginationConfigTransfer::class, $this->conditionalAvailabilityConfig->getConditionalAvailabilityPaginationConfigTransfer());
    }
}
