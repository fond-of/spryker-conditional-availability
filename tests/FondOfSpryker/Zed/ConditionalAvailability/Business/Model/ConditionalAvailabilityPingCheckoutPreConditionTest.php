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
    protected $checkoutResponseTransferMock;

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

        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPingCheckoutPreCondition = new ConditionalAvailabilityPingCheckoutPreCondition(
            $this->conditionalAvailabilityConfigMock,
            $this->conditionalAvailabilityClientMock
        );
    }

    /**
     * @return void
     */
    public function testCheckCondition(): void
    {
        $this->conditionalAvailabilityClientMock->expects($this->atLeastOnce())
            ->method('conditionalAvailabilityLastPingSearch')
            ->willReturn([
                "pings" => [
                    ["qty" => "3"],
                ],
            ]);

        $this->assertIsBool($this->conditionalAvailabilityPingCheckoutPreCondition->checkCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock));
    }

    /**
     * @return void
     */
    public function testCheckConditionFail(): void
    {
        $this->conditionalAvailabilityClientMock->expects($this->atLeastOnce())
            ->method('conditionalAvailabilityLastPingSearch')
            ->willReturn([]);

        $this->checkoutResponseTransferMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->checkoutResponseTransferMock);

        $this->checkoutResponseTransferMock->expects($this->atLeastOnce())
            ->method('setIsSuccess')
            ->with(false)
            ->willReturn($this->checkoutResponseTransferMock);

        $this->assertIsBool($this->conditionalAvailabilityPingCheckoutPreCondition->checkCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock));
    }
}
