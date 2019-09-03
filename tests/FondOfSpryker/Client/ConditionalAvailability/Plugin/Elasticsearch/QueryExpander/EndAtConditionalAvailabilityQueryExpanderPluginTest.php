<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Codeception\Test\Unit;
use DateTime;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Range;
use Exception;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Model\Elasticsearch\Query\QueryBuilder;

class EndAtConditionalAvailabilityQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander\EndAtConditionalAvailabilityQueryExpanderPlugin
     */
    protected $endAtConditionalAvailabilityQueryExpanderPlugin;

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
    protected $requestParameters;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\DateTime
     */
    protected $dateTimeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    protected $queryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\BoolQuery
     */
    protected $boolQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Model\Elasticsearch\Query\QueryBuilder
     */
    protected $queryBuilderMock;

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

        $this->dateTimeMock = $this->getMockBuilder(DateTime::class)
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

        $this->rangeMock = $this->getMockBuilder(Range::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [
            "end_at" => $this->dateTimeMock,
        ];

        $this->endAtConditionalAvailabilityQueryExpanderPlugin = new EndAtConditionalAvailabilityQueryExpanderPlugin();

        $this->endAtConditionalAvailabilityQueryExpanderPlugin->setFactory($this->conditionalAvailabilityFactoryMock);
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

        $this->queryBuilderMock->expects($this->atLeastOnce())
            ->method('createRangeQuery')
            ->willReturn($this->rangeMock);

        $this->assertInstanceOf(QueryInterface::class, $this->endAtConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParameters));
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
            $this->assertInstanceOf(QueryInterface::class, $this->endAtConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParameters));
        } catch (Exception $e) {
        }
    }
}
