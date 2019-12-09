<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use Exception;
use FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ConditionalAvailabilityWriter implements ConditionalAvailabilityWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutorInterface
     */
    protected $conditionalAvailabilityPluginExecutor;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface $entityManager
     * @param \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutorInterface $conditionalAvailabilityPluginExecutor
     */
    public function __construct(
        ConditionalAvailabilityEntityManagerInterface $entityManager,
        ConditionalAvailabilityPluginExecutorInterface $conditionalAvailabilityPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->conditionalAvailabilityPluginExecutor = $conditionalAvailabilityPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function create(ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer): ConditionalAvailabilityResponseTransfer
    {
        $conditionalAvailabilityResponseTransfer = (new ConditionalAvailabilityResponseTransfer())
            ->setConditionalAvailabilityTransfer($conditionalAvailabilityTransfer)
            ->setIsSuccessful(true);

        try {
            $conditionalAvailabilityResponseTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($conditionalAvailabilityResponseTransfer) {
                    return $this->executePersistTransaction($conditionalAvailabilityResponseTransfer);
                }
            );
        } catch (Exception $exception) {
            $conditionalAvailabilityResponseTransfer->setConditionalAvailabilityTransfer(null)
                ->setIsSuccessful(false);
        }

        return $conditionalAvailabilityResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function update(ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer): ConditionalAvailabilityResponseTransfer
    {
        $conditionalAvailabilityResponseTransfer = (new ConditionalAvailabilityResponseTransfer())
            ->setConditionalAvailabilityTransfer($conditionalAvailabilityTransfer)
            ->setIsSuccessful(true);

        try {
            $conditionalAvailabilityTransfer->requireIdConditionalAvailability();

            $conditionalAvailabilityResponseTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($conditionalAvailabilityResponseTransfer) {
                    return $this->executePersistTransaction($conditionalAvailabilityResponseTransfer);
                }
            );
        } catch (Exception $exception) {
            $conditionalAvailabilityResponseTransfer->setConditionalAvailabilityTransfer(null)
                ->setIsSuccessful(false);
        }

        return $conditionalAvailabilityResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    protected function executePersistTransaction(
        ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
    ): ConditionalAvailabilityResponseTransfer {
        $conditionalAvailabilityTransfer = $this->entityManager->persistConditionalAvailability(
            $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer()
        );

        $conditionalAvailabilityResponseTransfer->setConditionalAvailabilityTransfer(
            $conditionalAvailabilityTransfer
        );

        $conditionalAvailabilityResponseTransfer = $this->conditionalAvailabilityPluginExecutor
            ->executePostSavePlugins($conditionalAvailabilityResponseTransfer);

        return $conditionalAvailabilityResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function delete(ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer): ConditionalAvailabilityResponseTransfer
    {
        $conditionalAvailabilityResponseTransfer = (new ConditionalAvailabilityResponseTransfer())
            ->setIsSuccessful(true)
            ->setConditionalAvailabilityTransfer($conditionalAvailabilityTransfer);

        try {
            $conditionalAvailabilityTransfer->requireIdConditionalAvailability();

            $conditionalAvailabilityResponseTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($conditionalAvailabilityResponseTransfer) {
                    return $this->executeDeleteTransaction($conditionalAvailabilityResponseTransfer);
                }
            );
        } catch (Exception $exception) {
            $conditionalAvailabilityResponseTransfer->setConditionalAvailabilityTransfer(null)
                ->setIsSuccessful(false);
        }

        return $conditionalAvailabilityResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    protected function executeDeleteTransaction(
        ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
    ): ConditionalAvailabilityResponseTransfer {
        $conditionalAvailabilityTransfer = $conditionalAvailabilityResponseTransfer
            ->getConditionalAvailabilityTransfer();

        $this->entityManager->deleteConditionalAvailabilityById(
            $conditionalAvailabilityTransfer->getIdConditionalAvailability()
        );

        $conditionalAvailabilityResponseTransfer->setConditionalAvailabilityTransfer(null);

        return $conditionalAvailabilityResponseTransfer;
    }
}
