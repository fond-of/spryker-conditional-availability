<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Config;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaginationConfigTransfer;

class ConditionalAvailabilityPaginationConfigBuilderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Config\ConditionalAvailabilityPaginationConfigBuilder
     */
    protected $conditionalAvailabilityPaginationConfigBuilder;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaginationConfigTransfer
     */
    protected $paginationConfigTransferMock;

    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paginationConfigTransferMock = $this->getMockBuilder(PaginationConfigTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [
            "itemsPerPage" => 20,
        ];

        $this->conditionalAvailabilityPaginationConfigBuilder = new ConditionalAvailabilityPaginationConfigBuilder();
    }

    /**
     * @return void
     */
    public function testPaginationConfigTransfer(): void
    {
        $this->conditionalAvailabilityPaginationConfigBuilder->setPaginationConfigTransfer($this->paginationConfigTransferMock);

        $this->assertInstanceOf(PaginationConfigTransfer::class, $this->conditionalAvailabilityPaginationConfigBuilder->getPaginationConfigTransfer());
    }

    /**
     * @return void
     */
    public function testGetCurrentPage(): void
    {
        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('requireParameterName')
            ->willReturn($this->paginationConfigTransferMock);

        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getParameterName')
            ->willReturn("string");

        $this->conditionalAvailabilityPaginationConfigBuilder->setPaginationConfigTransfer($this->paginationConfigTransferMock);

        $this->assertSame(1, $this->conditionalAvailabilityPaginationConfigBuilder->getCurrentPage($this->requestParameters));
    }

    /**
     * @return void
     */
    public function testGetCurrentItemsPerPage(): void
    {
        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getItemsPerPageParameterName')
            ->willReturn("itemsPerPage");

        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getValidItemsPerPageOptions')
            ->willReturn(["itemsPerPage" => 20]);

        $this->conditionalAvailabilityPaginationConfigBuilder->setPaginationConfigTransfer($this->paginationConfigTransferMock);

        $this->assertSame(20, $this->conditionalAvailabilityPaginationConfigBuilder->getCurrentItemsPerPage($this->requestParameters));
    }

    /**
     * @return void
     */
    public function testGetCurrentItemsPerPageDefault(): void
    {
        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getItemsPerPageParameterName')
            ->willReturn("string");

        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getDefaultItemsPerPage')
            ->willReturn(20);

        $this->conditionalAvailabilityPaginationConfigBuilder->setPaginationConfigTransfer($this->paginationConfigTransferMock);

        $this->assertSame(20, $this->conditionalAvailabilityPaginationConfigBuilder->getCurrentItemsPerPage($this->requestParameters));
    }
}
