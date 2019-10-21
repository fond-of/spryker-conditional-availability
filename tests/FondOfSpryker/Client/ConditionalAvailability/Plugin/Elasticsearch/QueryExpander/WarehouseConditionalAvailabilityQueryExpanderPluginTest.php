<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\QueryBuilder;
use Exception;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class WarehouseConditionalAvailabilityQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander\WarehouseConditionalAvailabilityQueryExpanderPlugin
     */
    protected $warehouseConditionalAvailabilityQueryExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected $queryInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory
     */
    protected $conditionalAvailabilityFactoryMock;

    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    private $queryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\BoolQuery
     */
    private $boolQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\QueryBuilder
     */
    private $queryBuilderMock;

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

        $this->queryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->boolQueryMock = $this->getMockBuilder(BoolQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [
            "warehouse" => "",
        ];

        $this->warehouseConditionalAvailabilityQueryExpanderPlugin = new WarehouseConditionalAvailabilityQueryExpanderPlugin();
        $this->warehouseConditionalAvailabilityQueryExpanderPlugin->setFactory($this->conditionalAvailabilityFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects($this->atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('createQueryBuilder')
            ->willReturn($this->queryBuilderMock);

        $this->assertInstanceOf(QueryInterface::class, $this->warehouseConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParameters));
    }

    /**
     * @return void
     */
    public function testExpandQueryInvalidArgumentException(): void
    {

        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects($this->atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->queryMock);

        try {
            $this->assertInstanceOf(QueryInterface::class, $this->warehouseConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParameters));
        } catch (Exception $e) {
        }
    }
}
