<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;

class ConditionalAvailabilityReader implements ConditionalAvailabilityReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutorInterface
     */
    protected $conditionalAvailabilityPluginExecutor;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutorInterface $conditionalAvailabilityPluginExecutor
     */
    public function __construct(
        ConditionalAvailabilityRepositoryInterface $repository,
        ConditionalAvailabilityPluginExecutorInterface $conditionalAvailabilityPluginExecutor
    ) {
        $this->repository = $repository;
        $this->conditionalAvailabilityPluginExecutor = $conditionalAvailabilityPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function findById(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityResponseTransfer {
        $conditionalAvailabilityTransfer->requireIdConditionalAvailability();

        $conditionalAvailabilityTransfer = $this->repository->findConditionalAvailabilityById(
            $conditionalAvailabilityTransfer->getIdConditionalAvailability()
        );

        $conditionalAvailabilityResponseTransfer = (new ConditionalAvailabilityResponseTransfer())
            ->setIsSuccessful(true)
            ->setConditionalAvailabilityTransfer($conditionalAvailabilityTransfer);

        if ($conditionalAvailabilityTransfer === null) {
            return $conditionalAvailabilityResponseTransfer->setIsSuccessful(false);
        }

        return $this->conditionalAvailabilityPluginExecutor
            ->executeHydrationPlugins($conditionalAvailabilityResponseTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer
     */
    public function findAll(): ConditionalAvailabilityCollectionTransfer
    {
        return $this->repository->findAllConditionalAvailabilities();
    }
}
