<?php

namespace FondOfSpryker\Client\Zed\ConditionalAvailability\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;
use FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityBusinessFactory;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreConditionInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreConditionInterface;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityDependencyProvider;
use ReflectionClass;
use ReflectionMethod;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Search\Business\Model\Elasticsearch\Generator\IndexMapGeneratorInterface;

class ConditionalAvailabilityBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityBusinessFactory
     */
    protected $conditionalAvailabilityBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreConditionInterface
     */
    protected $conditionalAvailabilityClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $conditionalAvailabilityConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreConditionInterface
     */
    protected $conditionalAvailabilityPingCheckoutPreConditionInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityConfigMock = $this->getMockBuilder(ConditionalAvailabilityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityClientInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPingCheckoutPreConditionInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPingCheckoutPreConditionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityBusinessFactory = new ConditionalAvailabilityBusinessFactory();
        $this->conditionalAvailabilityBusinessFactory->setContainer($this->containerMock);
        $this->conditionalAvailabilityBusinessFactory->setConfig($this->conditionalAvailabilityConfigMock);
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilityPreCondition(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ConditionalAvailabilityDependencyProvider::CLIENT)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityDependencyProvider::CLIENT)
            ->willReturn($this->conditionalAvailabilityClientInterfaceMock);

        $this->assertInstanceOf(ConditionalAvailabilityCheckoutPreConditionInterface::class, $this->conditionalAvailabilityBusinessFactory->createConditionalAvailabilityPreCondition());
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilityPingPreCondition(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ConditionalAvailabilityDependencyProvider::CLIENT)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityDependencyProvider::CLIENT)
            ->willReturn($this->conditionalAvailabilityClientInterfaceMock);

        $this->assertInstanceOf(ConditionalAvailabilityPingCheckoutPreConditionInterface::class, $this->conditionalAvailabilityBusinessFactory->createConditionalAvailabilityPingPreCondition());
    }

    /**
     * @return void
     */
    public function testCreateElasticsearchIndexMapGenerator(): void
    {
        $foo = self::getMethod('createElasticsearchIndexMapGenerator');
        $obj = new ConditionalAvailabilityBusinessFactory();
        $obj->setConfig($this->conditionalAvailabilityConfigMock);
        $this->assertInstanceOf(IndexMapGeneratorInterface::class, $foo->invokeArgs($obj, []));
    }

    /**
     * @return void
     */
    public function testCreateIndexClientProvider(): void
    {
        $foo = self::getMethod('createIndexProvider');
        $obj = new ConditionalAvailabilityBusinessFactory();
        $this->assertInstanceOf(IndexClientProvider::class, $foo->invokeArgs($obj, []));
    }

    /**
     * @param string $name
     *
     * @throws
     *
     * @return \ReflectionMethod
     */
    protected static function getMethod(string $name): ReflectionMethod
    {
        $class = new ReflectionClass(ConditionalAvailabilityBusinessFactory::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
