<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query;

use Codeception\Test\Unit;
use DateTime;
use Elastica\Query\BoolQuery;
use Elastica\QueryBuilder;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory;

class ConditionalAvailabilityPingSearchQueryPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilityPingSearchQueryPlugin
     */
    protected $conditionalAvailabilityPingSearchQueryPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\DateTime
     */
    protected $dateTimeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory
     */
    protected $conditionalAvailabilityFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\QueryBuilder
     */
    protected $queryBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\BoolQuery
     */
    protected $boolQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityFactoryMock = $this->getMockBuilder(ConditionalAvailabilityFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dateTimeMock = $this->getMockBuilder(DateTime::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->boolQueryMock = $this->getMockBuilder(BoolQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPingSearchQueryPlugin = new ConditionalAvailabilityPingSearchQueryPlugin();
        $this->conditionalAvailabilityPingSearchQueryPlugin->setFactory($this->conditionalAvailabilityFactoryMock);
    }

    /**
     * @return void
     */
    /*
    public function testSearchDateTimeFrom(): void
    {
        $this->conditionalAvailabilityPingSearchQueryPlugin->setSearchDateTimeRange($this->dateTimeMock, $this->dateTimeMock);
    }
    */
}
