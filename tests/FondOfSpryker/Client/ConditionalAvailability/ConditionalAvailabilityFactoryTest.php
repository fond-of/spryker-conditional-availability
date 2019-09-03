<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use Codeception\Test\Unit;
use DateTime;
use FondOfSpryker\Client\ConditionalAvailability\Config\PaginationConfigBuilderInterface;
use FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilityPingSearchQueryPlugin;
use FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilitySkuSearchQueryPlugin;
use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use ReflectionClass;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class ConditionalAvailabilityFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory
     */
    protected $conditionalAvailabilityFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $conditionalAvailabilityConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilitySkuSearchQueryPlugin
     */
    protected $conditionalAvailabilitySkuSearchQueryPluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\DateTime
     */
    protected $dateTimeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilityPingSearchQueryPlugin
     */
    protected $conditionalAvailabilityPingSearchQueryPluginMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityConfigMock = $this->getMockBuilder(ConditionalAvailabilityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilitySkuSearchQueryPluginMock = $this->getMockBuilder(ConditionalAvailabilitySkuSearchQueryPlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPingSearchQueryPluginMock = $this->getMockBuilder(ConditionalAvailabilityPingSearchQueryPlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dateTimeMock = $this->getMockBuilder(DateTime::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityFactory = new ConditionalAvailabilityFactory();
        $this->conditionalAvailabilityFactory->setConfig($this->conditionalAvailabilityConfigMock);
        $this->conditionalAvailabilityFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilitySkuSearchQuery(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_PLUGIN]
            )->willReturnOnConsecutiveCalls(
                true
            );

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_PLUGIN]
            )->willReturnOnConsecutiveCalls(
                $this->conditionalAvailabilitySkuSearchQueryPluginMock
            );

        $this->assertInstanceOf(QueryInterface::class, $this->conditionalAvailabilityFactory->createConditionalAvailabilitySkuSearchQuery("search"));
    }

    /**
     * @return void
     */
    public function testConditionalAvailabilityPingSearchQuery(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_PLUGIN]
            )->willReturnOnConsecutiveCalls(
                true
            );

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_PLUGIN]
            )->willReturnOnConsecutiveCalls(
                $this->conditionalAvailabilityPingSearchQueryPluginMock
            );

        $this->assertInstanceOf(QueryInterface::class, $this->conditionalAvailabilityFactory->createConditionalAvailabilityPingSearchQuery($this->dateTimeMock, $this->dateTimeMock));
    }

    /**
     * @return void
     */
    public function testPaginationConfigBuilder(): void
    {
        $this->assertInstanceOf(PaginationConfigBuilderInterface::class, $this->conditionalAvailabilityFactory->createPaginationConfigBuilder());
    }

    /**
     * @return void
     */
    public function testGetConditionalAvailabilitySkuSearchQueryExpanderPlugins(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_EXPANDER_PLUGINS)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_EXPANDER_PLUGINS)
            ->willReturn([]);

        $this->assertIsArray($this->conditionalAvailabilityFactory->getConditionalAvailabilitySkuSearchQueryExpanderPlugins());
    }

    /**
     * @return void
     */
    public function testGetConditionalAvailabilitySkuSearchQueryFormatterPlugins(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_FORMATTER_PLUGINS)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_FORMATTER_PLUGINS)
            ->willReturn([]);

        $this->assertIsArray($this->conditionalAvailabilityFactory->getConditionalAvailabilitySkuSearchQueryFormatterPlugins());
    }

    /**
     * @return void
     */
    public function testGetConditionalAvailabilityPingSearchQueryExpanderPlugins(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_EXPANDER_PLUGINS)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_EXPANDER_PLUGINS)
            ->willReturn([]);

        $this->assertIsArray($this->conditionalAvailabilityFactory->getConditionalAvailabilityPingSearchQueryExpanderPlugins());
    }

    /**
     * @return void
     */
    public function testGetConditionalAvailabilityPingSearchQueryFormatterPlugins(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_FORMATTER_PLUGINS)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityDependencyProvider::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_FORMATTER_PLUGINS)
            ->willReturn([]);

        $this->assertIsArray($this->conditionalAvailabilityFactory->getConditionalAvailabilityPingSearchQueryFormatterPlugins());
    }

    /**
     * @return void
     */
    public function testCreatePageIndexMap()
    {
        $foo = self::getMethod('createPageIndexMap');
        $obj = new ConditionalAvailabilityFactory();
        $this->assertInstanceOf(PageIndexMap::class, $foo->invokeArgs($obj, []));
    }

    /**
     * @return void
     */
    public function testCreateIndexClientProvider()
    {
        $foo = self::getMethod('createIndexClientProvider');
        $obj = new ConditionalAvailabilityFactory();
        $this->assertInstanceOf(IndexClientProvider::class, $foo->invokeArgs($obj, []));
    }

    /**
     * @param $name
     *
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new ReflectionClass(ConditionalAvailabilityFactory::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
