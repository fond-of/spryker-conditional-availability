<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory;

class ConditionalAvailabilitySkuSearchQueryPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilitySkuSearchQueryPlugin
     */
    protected $conditionalAvailabilitySkuSearchQueryPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory
     */
    protected $conditionalAvailabilityFactoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityFactoryMock = $this->getMockBuilder(ConditionalAvailabilityFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilitySkuSearchQueryPlugin = new ConditionalAvailabilitySkuSearchQueryPlugin();
        $this->conditionalAvailabilitySkuSearchQueryPlugin->setFactory($this->conditionalAvailabilityFactoryMock);
    }

    /**
     * @return void
     */
    /*
    public function testSearchQuery(): void
    {
        $this->conditionalAvailabilitySkuSearchQueryPlugin->setSearchString("string");

        $this->assertSame("string", $this->conditionalAvailabilitySkuSearchQueryPlugin->getSearchString());
    }
    */
}
