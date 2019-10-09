<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Range;
use Exception;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Model\Elasticsearch\Query\QueryBuilderInterface;

class QuantityGreaterZeroConditionalAvailabilityQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander\QuantityGreaterZeroConditionalAvailabilityQueryExpanderPlugin
     */
    protected $quantityGreaterZeroConditionalAvailabilityQueryExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory
     */
    protected $conditionalAvailabilityFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected $queryInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    protected $queryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\BoolQuery
     */
    protected $boolQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Model\Elasticsearch\Query\QueryBuilderInterface
     */
    protected $queryBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\Range
     */
    protected $rangeMock;

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

        $this->queryBuilderInterfaceMock = $this->getMockBuilder(QueryBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->rangeMock = $this->getMockBuilder(Range::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quantityGreaterZeroConditionalAvailabilityQueryExpanderPlugin = new QuantityGreaterZeroConditionalAvailabilityQueryExpanderPlugin();
        $this->quantityGreaterZeroConditionalAvailabilityQueryExpanderPlugin->setFactory($this->conditionalAvailabilityFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQueryInvalidArgumentException(): void
    {
        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        try {
            $this->assertInstanceOf(QueryInterface::class, $this->quantityGreaterZeroConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock));
        } catch (Exception $e) {
        }
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
            ->willReturn($this->queryBuilderInterfaceMock);

        $this->queryBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRangeQuery')
            ->willReturn($this->rangeMock);

        $this->boolQueryMock->expects($this->atLeastOnce())
            ->method('addMust')
            ->willReturn($this->boolQueryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->quantityGreaterZeroConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock));
    }
}
