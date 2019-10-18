<?php

namespace FondOfSpryker\Client\Zed\ConditionalAvailability\Business\Model\Elasticsearch;

use ArrayObject;
use Codeception\Test\Unit;
use DateTime;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreCondition;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ConditionalAvailabilityCheckoutPreConditionTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreCondition
     */
    protected $conditionalAvailabilityCheckoutPreCondition;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $conditionalAvailabilityConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var array
     */
    protected $itemTransfers;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $dateTimeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityConfigMock = $this->getMockBuilder(ConditionalAvailabilityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityClientMock = $this->getMockBuilder(ConditionalAvailabilityClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dateTimeMock = $this->getMockBuilder(DateTime::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransfers = new ArrayObject(
            [
                $this->itemTransferMock,
            ]
        );

        $this->conditionalAvailabilityCheckoutPreCondition = new ConditionalAvailabilityCheckoutPreCondition(
            $this->conditionalAvailabilityConfigMock,
            $this->conditionalAvailabilityClientMock
        );
    }

    /**
     * @return void
     */
    public function testCheckCondition(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransfers);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getSku')
            ->willReturn("sku");

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getConcreteDeliveryDate')
            ->willReturn("2019-08-27");

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getQuantity')
            ->willReturn(1);

        $this->conditionalAvailabilityClientMock->expects($this->atLeastOnce())
            ->method('conditionalAvailabilitySkuSearch')
            ->willReturn([
                "periods" => [
                    ["qty" => "3"],
                ],
            ]);

        $this->assertIsBool($this->conditionalAvailabilityCheckoutPreCondition->checkCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock));
    }

    /**
     * @return void
     */
    public function testCheckConditionLowerAvailableQuantity(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransfers);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getSku')
            ->willReturn("sku");

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getConcreteDeliveryDate')
            ->willReturn("2019-08-27");

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getQuantity')
            ->willReturn(5);

        $this->conditionalAvailabilityClientMock->expects($this->atLeastOnce())
            ->method('conditionalAvailabilitySkuSearch')
            ->willReturn([
                "periods" => [
                    ["qty" => "3"],
                ],
            ]);

        $this->checkoutResponseTransferMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->checkoutResponseTransferMock);

        $this->checkoutResponseTransferMock->expects($this->atLeastOnce())
            ->method('setIsSuccess')
            ->with(false)
            ->willReturn($this->checkoutResponseTransferMock);

        $this->assertIsBool($this->conditionalAvailabilityCheckoutPreCondition->checkCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock));
    }

    /**
     * @return void
     */
    public function testCheckConditionFail(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransfers);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getSku')
            ->willReturn("sku");

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getConcreteDeliveryDate')
            ->willReturn("2019-08-27");

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getQuantity')
            ->willReturn(1);

        $this->conditionalAvailabilityClientMock->expects($this->atLeastOnce())
            ->method('conditionalAvailabilitySkuSearch')
            ->willReturn([]);

        $this->checkoutResponseTransferMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->checkoutResponseTransferMock);

        $this->checkoutResponseTransferMock->expects($this->atLeastOnce())
            ->method('setIsSuccess')
            ->with(false)
            ->willReturn($this->checkoutResponseTransferMock);

        $this->assertIsBool($this->conditionalAvailabilityCheckoutPreCondition->checkCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock));
    }
}
