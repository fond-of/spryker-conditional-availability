<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use Codeception\Test\Unit;
use Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface;
use Spryker\Client\Search\Model\Handler\SearchHandlerInterface;

class ConditionalAvailabilityClientTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClient
     */
    protected $conditionalAvailabilityClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory
     */
    protected $conditionalAvailabilityFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected $queryInterfaceMock;

    /**
     * @var array
     */
    protected $queryExpanderPlugins;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface
     */
    protected $queryExpanderPluginInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Model\Handler\SearchHandlerInterface
     */
    protected $searchHandlerInterfaceMock;

    /**
     * @var array
     */
    protected $queryFormatterPlugins;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $queryFormatterPluginMock;

    /**
     * @var array
     */
    private $requestParameters;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityFactoryMock = $this->getMockBuilder(ConditionalAvailabilityFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryInterfaceMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryExpanderPluginInterfaceMock = $this->getMockBuilder(QueryExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchHandlerInterfaceMock = $this->getMockBuilder(SearchHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryExpanderPlugins = [
            $this->queryExpanderPluginInterfaceMock,
        ];

        $this->requestParameters = [
            "sort" => "asc",
        ];

        $this->queryFormatterPluginMock = $this->getMockBuilder(ResultFormatterPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryFormatterPlugins = [
            $this->queryFormatterPluginMock,
        ];

        $this->conditionalAvailabilityClient = new ConditionalAvailabilityClient();
        $this->conditionalAvailabilityClient->setFactory($this->conditionalAvailabilityFactoryMock);
    }

    /**
     * TODO: fix
     * @return void
     */
    /*
    public function testConditionalAvailabilitySkuSearch(): void
    {
        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('createConditionalAvailabilitySkuSearchQuery')
            ->willReturn($this->queryInterfaceMock);

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('getConditionalAvailabilitySkuSearchQueryExpanderPlugins')
            ->willReturn($this->queryExpanderPlugins);

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('getConditionalAvailabilitySkuSearchQueryFormatterPlugins')
            ->willReturn($this->queryFormatterPlugins);

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('createElasticsearchSearchHandler')
            ->willReturn($this->searchHandlerInterfaceMock);

        $this->assertIsArray($this->conditionalAvailabilityClient->conditionalAvailabilitySkuSearch("search"));
    }
    */
}
