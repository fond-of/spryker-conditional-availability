<?php

namespace FondOfSpryker\Client\Zed\ConditionalAvailability\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacade;
use FondOfSpryker\Zed\ConditionalAvailability\Communication\Plugin\ConditionalAvailabilityPingCheckoutPreConditionPlugin;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ConditionalAvailabilityPingCheckoutPreConditionPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Communication\Plugin\ConditionalAvailabilityPingCheckoutPreConditionPlugin
     */
    protected $conditionalAvailabilityPingCheckoutPreConditionPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacade
     */
    protected $conditionalAvailabilityFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CheckoutResponseTransfer
     */
    protected $checkoutResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityFacadeMock = $this->getMockBuilder(ConditionalAvailabilityFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPingCheckoutPreConditionPlugin = new ConditionalAvailabilityPingCheckoutPreConditionPlugin();
        $this->conditionalAvailabilityPingCheckoutPreConditionPlugin->setFacade($this->conditionalAvailabilityFacadeMock);
    }

    /**
     * @return void
     */
    public function testCheckCondition(): void
    {
        $this->assertIsBool($this->conditionalAvailabilityPingCheckoutPreConditionPlugin->checkCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock));
    }
}
