<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;

class ConditionalAvailabilityPeriodsPersister implements ConditionalAvailabilityPeriodsPersisterInterface
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface $entityManager
     */
    public function __construct(ConditionalAvailabilityEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer
     */
    public function persist(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityTransfer {
        if (
            $conditionalAvailabilityTransfer->getIdConditionalAvailability() === null
            || $conditionalAvailabilityTransfer->getConditionalAvailabilityPeriodCollection() === null
        ) {
            return $conditionalAvailabilityTransfer;
        }

        $this->entityManager->deleteConditionalAvailabilityPeriodsByConditionalAvailabilityId(
            $conditionalAvailabilityTransfer->getIdConditionalAvailability(),
        );

        $conditionalAvailabilityPeriodTransfers = $conditionalAvailabilityTransfer
            ->getConditionalAvailabilityPeriodCollection()
            ->getConditionalAvailabilityPeriods();

        foreach ($conditionalAvailabilityPeriodTransfers as $conditionalAvailabilityPeriodTransfer) {
            $conditionalAvailabilityPeriodTransfer->setFkConditionalAvailability(
                $conditionalAvailabilityTransfer->getIdConditionalAvailability(),
            );

            $this->entityManager->createConditionalAvailabilityPeriod($conditionalAvailabilityPeriodTransfer);
        }

        return $conditionalAvailabilityTransfer;
    }
}
