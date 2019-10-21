<?php

namespace FondOfSpryker\Client\Zed\ConditionalAvailability\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityBusinessFactory;
use FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacade;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ConditionalAvailabilityFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacade
     */
    protected $conditionalAvailabilityFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityBusinessFactory
     */
    protected $conditionalAvailabilityBusinessFactory;

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

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityBusinessFactory = $this->getMockBuilder(ConditionalAvailabilityBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityFacade = new ConditionalAvailabilityFacade();
        $this->conditionalAvailabilityFacade->setFactory($this->conditionalAvailabilityBusinessFactory);
    }

    /**
     * @return void
     */
    public function testCheckoutConditionalAvailabilityPreCondition(): void
    {
        $this->assertIsBool($this->conditionalAvailabilityFacade->checkoutConditionalAvailabilityPreCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock));
    }

    /**
     * @return void
     */
    public function testCheckoutConditionalAvailabilityPingPreCondition(): void
    {
        $this->assertIsBool($this->conditionalAvailabilityFacade->checkoutConditionalAvailabilityPingPreCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock));
    }
}
