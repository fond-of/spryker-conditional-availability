<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\ResultFormatter;

use Codeception\Test\Unit;
use Elastica\Result;
use Elastica\ResultSet;

class RawConditionalAvailabilityPeriodResultFormatterPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\ResultFormatter\RawConditionalAvailabilityPeriodResultFormatterPlugin
     */
    protected $rawConditionalAvailabilityPeriodResultFormatterPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\ResultSet
     */
    protected $resultSetMock;

    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * @var array
     */
    protected $results;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Result
     */
    protected $resultMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resultSetMock = $this->getMockBuilder(ResultSet::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [

        ];

        $this->resultMock = $this->getMockBuilder(Result::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->results = [
            $this->resultMock,
        ];

        $this->rawConditionalAvailabilityPeriodResultFormatterPlugin = new RawConditionalAvailabilityPeriodResultFormatterPlugin();
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertSame('periods', $this->rawConditionalAvailabilityPeriodResultFormatterPlugin->getName());
    }

    /**
     * @return void
     */
    public function testFormatSearchResult(): void
    {
        $this->resultSetMock->expects($this->atLeastOnce())
            ->method('getResults')
            ->willReturn($this->results);

        $this->assertIsArray($this->rawConditionalAvailabilityPeriodResultFormatterPlugin->formatResult($this->resultSetMock, $this->requestParameters));
    }
}
