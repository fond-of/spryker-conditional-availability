<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Codeception\Test\Unit;
use Elastica\Query;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class MaxSizeConditionalAvailabilityQueryPluginExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander\MaxSizeConditionalAvailabilityQueryPluginExpander
     */
    protected $maxSizeConditionalAvailabilityQueryPluginExpander;

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

        $this->maxSizeConditionalAvailabilityQueryPluginExpander = new MaxSizeConditionalAvailabilityQueryPluginExpander();
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->maxSizeConditionalAvailabilityQueryPluginExpander->expandQuery($this->queryInterfaceMock));
    }
}
