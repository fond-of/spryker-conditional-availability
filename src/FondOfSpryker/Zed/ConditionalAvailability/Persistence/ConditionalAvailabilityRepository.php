<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence;

use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityPersistenceFactory getFactory()
 */
class ConditionalAvailabilityRepository extends AbstractRepository implements ConditionalAvailabilityRepositoryInterface
{
    /**
     * @param int $idConditionalAvailability
     *
     * @throws
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer|null
     */
    public function findConditionalAvailabilityById(int $idConditionalAvailability): ?ConditionalAvailabilityTransfer
    {
        $fosConditionalAvailability = $this->getFactory()
            ->createConditionalAvailabilityQuery()
            ->filterByIdConditionalAvailability($idConditionalAvailability)
            ->findOne();

        if (!$fosConditionalAvailability) {
            return null;
        }

        return $this->getFactory()
            ->createConditionalAvailabilityMapper()
            ->mapEntityToTransfer($fosConditionalAvailability, new ConditionalAvailabilityTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer
     */
    public function findAllConditionalAvailabilities(): ConditionalAvailabilityCollectionTransfer
    {
        $fosConditionalAvailabilities = $this->getFactory()
            ->createConditionalAvailabilityQuery()
            ->find();

        $conditionalAvailabilityCollectionTransfer = new ConditionalAvailabilityCollectionTransfer();

        foreach ($fosConditionalAvailabilities as $fosConditionalAvailability) {
            $conditionalAvailabilityTransfer = $this->getFactory()
                ->createConditionalAvailabilityMapper()
                ->mapEntityToTransfer($fosConditionalAvailability, new ConditionalAvailabilityTransfer());

            $conditionalAvailabilityCollectionTransfer->addConditionalAvailability($conditionalAvailabilityTransfer);
        }

        return $conditionalAvailabilityCollectionTransfer;
    }

    /**
     * @param int $fkConditionalAvailability
     *
     * @throws
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer
     */
    public function findConditionalAvailabilityPeriodsByFkConditionalAvailability(
        int $fkConditionalAvailability
    ): ConditionalAvailabilityPeriodCollectionTransfer {
        $fosConditionalAvailabilities = $this->getFactory()
            ->createConditionalAvailabilityPeriodQuery()
            ->filterByFkConditionalAvailability($fkConditionalAvailability)
            ->find();

        $conditionalAvailabilityPeriodCollectionTransfer = new ConditionalAvailabilityPeriodCollectionTransfer();

        foreach ($fosConditionalAvailabilities as $fosConditionalAvailability) {
            $conditionalAvailabilityPeriodTransfer = $this->getFactory()
                ->createConditionalAvailabilityPeriodMapper()
                ->mapEntityToTransfer($fosConditionalAvailability, new ConditionalAvailabilityPeriodTransfer());

            $conditionalAvailabilityPeriodCollectionTransfer
                ->addConditionalAvailabilityPeriod($conditionalAvailabilityPeriodTransfer);
        }

        return $conditionalAvailabilityPeriodCollectionTransfer;
    }
}
