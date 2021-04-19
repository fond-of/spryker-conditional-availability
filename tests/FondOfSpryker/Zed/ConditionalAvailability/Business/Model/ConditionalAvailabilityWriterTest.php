<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Propel\Runtime\Connection\ConnectionInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class ConditionalAvailabilityWriterTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityWriter
     */
    protected $conditionalAvailabilityWriter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|ConditionalAvailabilityPluginExecutorInterface
     */
    protected $conditionalAvailabilityPluginExecutorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface
     */
    protected $conditionalAvailabilityEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ConditionalAvailabilityTransfer
     */
    protected $conditionalAvailabilityTransferMock;

    /**
     * @var \Propel\Runtime\Connection\ConnectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $connectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->connectionMock = $this->getMockBuilder(ConnectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityTransferMock = $this->getMockBuilder(ConditionalAvailabilityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityEntityManagerMock = $this->getMockBuilder(ConditionalAvailabilityEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPluginExecutorMock = $this->getMockBuilder(ConditionalAvailabilityPluginExecutorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityWriter = new class (
            $this->conditionalAvailabilityEntityManagerMock,
            $this->conditionalAvailabilityPluginExecutorMock
        ) extends ConditionalAvailabilityWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler(): TransactionHandlerInterface
            {
                if ($this->transactionHandler === null) {
                    $this->transactionHandler = parent::getTransactionHandler();
                }

                return $this->transactionHandler;
            }
        };

        $this->conditionalAvailabilityWriter->getTransactionHandler()
            ->setConnection($this->connectionMock);
    }

    /**
     * @return void
     */
    public function testCreateWithError(): void
    {
        $this->connectionMock->expects($this->atLeastOnce())
            ->method('beginTransaction');

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('rollback');

        $this->conditionalAvailabilityEntityManagerMock->expects($this->atLeastOnce())
            ->method('saveConditionalAvailability')
            ->with($this->conditionalAvailabilityTransferMock)
            ->willThrowException(new Exception());

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityWriter->create(
            $this->conditionalAvailabilityTransferMock
        );

        $this->assertFalse($conditionalAvailabilityResponseTransfer->getIsSuccessful());
        $this->assertEquals(null, $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer());
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->connectionMock->expects($this->atLeastOnce())
            ->method('beginTransaction');

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('commit');

        $this->conditionalAvailabilityEntityManagerMock->expects($this->atLeastOnce())
            ->method('saveConditionalAvailability')
            ->with($this->conditionalAvailabilityTransferMock)
            ->willReturn($this->conditionalAvailabilityTransferMock);

        $this->conditionalAvailabilityPluginExecutorMock->expects($this->atLeastOnce())
            ->method('executePostSavePlugins')
            ->withAnyParameters()
            ->willReturnCallback(static function (ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer) {
                return $conditionalAvailabilityResponseTransfer;
            });

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityWriter->create(
            $this->conditionalAvailabilityTransferMock
        );

        $this->assertTrue($conditionalAvailabilityResponseTransfer->getIsSuccessful());
        $this->assertEquals(
            $this->conditionalAvailabilityTransferMock,
            $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer()
        );
    }

    /**
     * @return void
     */
    public function testPersist(): void
    {
        $this->connectionMock->expects($this->atLeastOnce())
            ->method('beginTransaction');

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('commit');

        $this->conditionalAvailabilityEntityManagerMock->expects($this->atLeastOnce())
            ->method('persistConditionalAvailability')
            ->with($this->conditionalAvailabilityTransferMock)
            ->willReturn($this->conditionalAvailabilityTransferMock);

        $this->conditionalAvailabilityPluginExecutorMock->expects($this->atLeastOnce())
            ->method('executePostSavePlugins')
            ->withAnyParameters()
            ->willReturnCallback(static function (ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer) {
                return $conditionalAvailabilityResponseTransfer;
            });

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityWriter->persist(
            $this->conditionalAvailabilityTransferMock
        );

        $this->assertTrue($conditionalAvailabilityResponseTransfer->getIsSuccessful());
        $this->assertEquals(
            $this->conditionalAvailabilityTransferMock,
            $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer()
        );
    }

    /**
     * @return void
     */
    public function testPersistWithError(): void
    {
        $this->connectionMock->expects($this->atLeastOnce())
            ->method('beginTransaction');

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('rollback');

        $this->conditionalAvailabilityEntityManagerMock->expects($this->atLeastOnce())
            ->method('persistConditionalAvailability')
            ->with($this->conditionalAvailabilityTransferMock)
            ->willThrowException(new Exception());

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityWriter->persist(
            $this->conditionalAvailabilityTransferMock
        );

        $this->assertFalse($conditionalAvailabilityResponseTransfer->getIsSuccessful());
        $this->assertEquals(null, $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer());
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $this->connectionMock->expects($this->atLeastOnce())
            ->method('beginTransaction');

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('rollback');

        $this->conditionalAvailabilityEntityManagerMock->expects($this->atLeastOnce())
            ->method('saveConditionalAvailability')
            ->with($this->conditionalAvailabilityTransferMock)
            ->willThrowException(new Exception());

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityWriter->update(
            $this->conditionalAvailabilityTransferMock
        );

        $this->assertFalse($conditionalAvailabilityResponseTransfer->getIsSuccessful());
        $this->assertEquals(null, $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer());
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->connectionMock->expects($this->atLeastOnce())
            ->method('beginTransaction');

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('commit');

        $this->conditionalAvailabilityEntityManagerMock->expects($this->atLeastOnce())
            ->method('saveConditionalAvailability')
            ->with($this->conditionalAvailabilityTransferMock)
            ->willReturn($this->conditionalAvailabilityTransferMock);

        $this->conditionalAvailabilityPluginExecutorMock->expects($this->atLeastOnce())
            ->method('executePostSavePlugins')
            ->withAnyParameters()
            ->willReturnCallback(static function (ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer) {
                return $conditionalAvailabilityResponseTransfer;
            });

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityWriter->update(
            $this->conditionalAvailabilityTransferMock
        );

        $this->assertTrue($conditionalAvailabilityResponseTransfer->getIsSuccessful());
        $this->assertEquals(
            $this->conditionalAvailabilityTransferMock,
            $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer()
        );
    }

    /**
     * @return void
     */
    public function testDeleteWithError(): void
    {
        $idConditionalAvailability = 1;

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('beginTransaction');

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('rollback');

        $this->conditionalAvailabilityTransferMock->expects($this->atLeastOnce())
            ->method('getIdConditionalAvailability')
            ->willReturn($idConditionalAvailability);

        $this->conditionalAvailabilityTransferMock->expects($this->atLeastOnce())
            ->method('requireIdConditionalAvailability')
            ->willReturn($this->conditionalAvailabilityTransferMock);

        $this->conditionalAvailabilityEntityManagerMock->expects($this->atLeastOnce())
            ->method('deleteConditionalAvailabilityById')
            ->with($idConditionalAvailability)
            ->willThrowException(new Exception());

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityWriter->delete(
            $this->conditionalAvailabilityTransferMock
        );

        $this->assertFalse($conditionalAvailabilityResponseTransfer->getIsSuccessful());
        $this->assertEquals(
            null,
            $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer()
        );
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $idConditionalAvailability = 1;

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('beginTransaction');

        $this->connectionMock->expects($this->atLeastOnce())
            ->method('commit');

        $this->conditionalAvailabilityTransferMock->expects($this->atLeastOnce())
            ->method('requireIdConditionalAvailability')
            ->willReturn($this->conditionalAvailabilityTransferMock);

        $this->conditionalAvailabilityTransferMock->expects($this->atLeastOnce())
            ->method('getIdConditionalAvailability')
            ->willReturn($idConditionalAvailability);

        $this->conditionalAvailabilityEntityManagerMock->expects($this->atLeastOnce())
            ->method('deleteConditionalAvailabilityById')
            ->with($idConditionalAvailability);

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityWriter->delete(
            $this->conditionalAvailabilityTransferMock
        );

        $this->assertTrue($conditionalAvailabilityResponseTransfer->getIsSuccessful());
        $this->assertEquals(
            null,
            $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer()
        );
    }
}
