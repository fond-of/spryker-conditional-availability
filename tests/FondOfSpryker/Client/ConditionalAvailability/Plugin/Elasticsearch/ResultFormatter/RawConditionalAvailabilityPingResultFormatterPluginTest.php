<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\ResultFormatter;

use Codeception\Test\Unit;
use Elastica\Result;
use Elastica\ResultSet;

class RawConditionalAvailabilityPingResultFormatterPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\ResultFormatter\RawConditionalAvailabilityPingResultFormatterPlugin
     */
    protected $rawConditionalAvailabilityPingResultFormatterPlugin;

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

        $this->rawConditionalAvailabilityPingResultFormatterPlugin = new RawConditionalAvailabilityPingResultFormatterPlugin();
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertSame('pings', $this->rawConditionalAvailabilityPingResultFormatterPlugin->getName());
    }

    /**
     * @return void
     */
    public function testFormatSearchResult(): void
    {
        $this->resultSetMock->expects($this->atLeastOnce())
            ->method('getResults')
            ->willReturn($this->results);

        $this->assertIsArray($this->rawConditionalAvailabilityPingResultFormatterPlugin->formatResult($this->resultSetMock, $this->requestParameters));
    }
}
