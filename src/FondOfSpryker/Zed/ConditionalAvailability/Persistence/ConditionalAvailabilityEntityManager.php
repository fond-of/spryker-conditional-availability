<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence;

use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriod;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityPersistenceFactory getFactory()
 */
class ConditionalAvailabilityEntityManager extends AbstractEntityManager implements ConditionalAvailabilityEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @throws
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer
     */
    public function persistConditionalAvailability(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityTransfer {
        $fosConditionalAvailabilityQuery = $this->getFactory()->createConditionalAvailabilityQuery();

        $fosConditionalAvailability = $fosConditionalAvailabilityQuery
            ->filterByIdConditionalAvailability($conditionalAvailabilityTransfer->getIdConditionalAvailability())
            ->findOneOrCreate();

        $fosConditionalAvailability = $this->getFactory()
            ->createConditionalAvailabilityMapper()
            ->mapTransferToEntity($conditionalAvailabilityTransfer, $fosConditionalAvailability);

        $fosConditionalAvailability->save();

        $conditionalAvailabilityTransfer->setIdConditionalAvailability(
            $fosConditionalAvailability->getIdConditionalAvailability()
        );

        return $conditionalAvailabilityTransfer;
    }

    /**
     * @param int $idConditionalAvailability
     *
     * @throws
     *
     * @return void
     */
    public function deleteConditionalAvailabilityById(int $idConditionalAvailability): void
    {
        $this->getFactory()
            ->createConditionalAvailabilityQuery()
            ->filterByIdConditionalAvailability($idConditionalAvailability)
            ->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer $conditionalAvailabilityPeriodTransfer
     *
     * @throws
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer
     */
    public function createConditionalAvailabilityPeriod(
        ConditionalAvailabilityPeriodTransfer $conditionalAvailabilityPeriodTransfer
    ): ConditionalAvailabilityPeriodTransfer {
        $fosConditionalAvailabilityPeriod = $this->getFactory()
            ->createConditionalAvailabilityPeriodMapper()
            ->mapTransferToEntity(
                $conditionalAvailabilityPeriodTransfer,
                new FosConditionalAvailabilityPeriod()
            );

        $fosConditionalAvailabilityPeriod->save();

        return $conditionalAvailabilityPeriodTransfer;
    }

    /**
     * @param int $idConditionalAvailability
     *
     * @throws
     *
     * @return void
     */
    public function deleteConditionalAvailabilityPeriodsByConditionalAvailabilityId(int $idConditionalAvailability): void
    {
        $fosConditionalAvailabilityPeriodQuery = $this->getFactory()->createConditionalAvailabilityPeriodQuery();

        $fosConditionalAvailabilityPeriods = $fosConditionalAvailabilityPeriodQuery
            ->filterByFkConditionalAvailability($idConditionalAvailability)
            ->find();

        foreach ($fosConditionalAvailabilityPeriods as $fosConditionalAvailabilityPeriod) {
            $fosConditionalAvailabilityPeriod->delete();
        }
    }
}
