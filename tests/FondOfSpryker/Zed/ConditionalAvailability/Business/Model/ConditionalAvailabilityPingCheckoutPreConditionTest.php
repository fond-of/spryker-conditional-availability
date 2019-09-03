<?php

namespace FondOfSpryker\Client\Zed\ConditionalAvailability\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClient;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreCondition;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ConditionalAvailabilityPingCheckoutPreConditionTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreCondition
     */
    protected $conditionalAvailabilityPingCheckoutPreCondition;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\zed\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $conditionalAvailabilityConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClient
     */
    protected $conditionalAvailabilityClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CheckoutResponseTransfer
     */
    protected $checkoutResponseMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityConfigMock = $this->getMockBuilder(ConditionalAvailabilityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityClientMock = $this->getMockBuilder(ConditionalAvailabilityClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutResponseMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPingCheckoutPreCondition = new ConditionalAvailabilityPingCheckoutPreCondition(
            $this->conditionalAvailabilityConfigMock,
            $this->conditionalAvailabilityClientMock
        );
    }

    /**
     * TODO: here
     * @return void
     */
    /*
    public function testCheckCondition(): void
    {
        $this->assertIsBool($this->conditionalAvailabilityPingCheckoutPreCondition->checkCondition($this->quoteTransferMock, $this->checkoutResponseMock));
    }
    */
}
