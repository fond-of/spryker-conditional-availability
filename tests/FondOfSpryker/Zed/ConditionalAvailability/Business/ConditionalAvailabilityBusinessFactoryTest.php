<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPeriodsPersister;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityReader;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityWriter;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\GroupedConditionalAvailabilityReader;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityDependencyProvider;
use FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManager;
use FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepository;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;

class ConditionalAvailabilityBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityBusinessFactory
     */
    protected $businessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockBuilder|\FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepository
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManager
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ConditionalAvailabilityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ConditionalAvailabilityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ConditionalAvailabilityEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new class ($this->loggerMock) extends ConditionalAvailabilityBusinessFactory {
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected $logger;

            /**
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(LoggerInterface $logger)
            {
                $this->logger = $logger;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->logger;
            }
        };
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setConfig($this->configMock);
        $this->businessFactory->setRepository($this->repositoryMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilityReader(): void
    {
        static::assertInstanceOf(
            ConditionalAvailabilityReader::class,
            $this->businessFactory->createConditionalAvailabilityReader(),
        );
    }

    /**
     * @return void
     */
    public function testCreateGroupedConditionalAvailabilityReader(): void
    {
        static::assertInstanceOf(
            GroupedConditionalAvailabilityReader::class,
            $this->businessFactory->createGroupedConditionalAvailabilityReader(),
        );
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilityPeriodsPersister(): void
    {
        static::assertInstanceOf(
            ConditionalAvailabilityPeriodsPersister::class,
            $this->businessFactory->createConditionalAvailabilityPeriodsPersister(),
        );
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilityWriter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ConditionalAvailabilityDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_POST_SAVE)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_POST_SAVE)
            ->willReturn([]);

        static::assertInstanceOf(
            ConditionalAvailabilityWriter::class,
            $this->businessFactory->createConditionalAvailabilityWriter(),
        );
    }
}
