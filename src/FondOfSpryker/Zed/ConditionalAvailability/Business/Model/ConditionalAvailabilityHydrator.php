<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;

class ConditionalAvailabilityHydrator implements ConditionalAvailabilityHydratorInterface
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface $repository
     */
    public function __construct(ConditionalAvailabilityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer
     */
    public function hydrateWithConditionalAvailabilityPeriods(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityTransfer {
        $idConditionalAvailability = $conditionalAvailabilityTransfer->getIdConditionalAvailability();

        if ($idConditionalAvailability === null) {
            return $conditionalAvailabilityTransfer;
        }

        $conditionalAvailabilityPeriodCollectionTransfer = $this->repository
            ->findConditionalAvailabilityPeriodsByFkConditionalAvailability($idConditionalAvailability);

        return $conditionalAvailabilityTransfer->setConditionalAvailabilityPeriodCollection(
            $conditionalAvailabilityPeriodCollectionTransfer
        );
    }
}
