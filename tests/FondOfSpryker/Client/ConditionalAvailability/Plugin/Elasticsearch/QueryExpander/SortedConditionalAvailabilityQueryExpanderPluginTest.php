<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Codeception\Test\Unit;
use Elastica\Query;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class SortedConditionalAvailabilityQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander\SortedConditionalAvailabilityQueryExpanderPlugin
     */
    protected $sortedConditionalAvailabilityQueryExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected $queryInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    protected $queryMock;

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

        $this->sortedConditionalAvailabilityQueryExpanderPlugin = new SortedConditionalAvailabilityQueryExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandQueryNoSort(): void
    {
        $this->assertInstanceOf(QueryInterface::class, $this->sortedConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock));
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $this->queryInterfaceMock->expects($this->atLeast(2))
            ->method('getSearchQuery')
            ->willReturnOnConsecutiveCalls(
                $this->queryInterfaceMock,
                $this->queryMock
            );

        $this->queryMock->expects($this->atLeastOnce())
            ->method('addSort')
            ->willReturn($this->queryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->sortedConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, ["sort" => ["field1" => "asc"]]));
    }
}
