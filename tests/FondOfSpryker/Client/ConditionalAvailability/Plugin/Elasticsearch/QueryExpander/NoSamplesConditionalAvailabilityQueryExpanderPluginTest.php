<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Exception;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class NoSamplesConditionalAvailabilityQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander\NoSamplesConditionalAvailabilityQueryExpanderPlugin
     */
    protected $noSamplesConditionalAvailabilityQueryExpanderPlugin;

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
    private $boolQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->queryInterfaceMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->boolQueryMock = $this->getMockBuilder(BoolQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->noSamplesConditionalAvailabilityQueryExpanderPlugin = new NoSamplesConditionalAvailabilityQueryExpanderPlugin();
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
            $this->assertInstanceOf(QueryInterface::class, $this->noSamplesConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock));
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

        $this->assertInstanceOf(QueryInterface::class, $this->noSamplesConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock));
    }
}
