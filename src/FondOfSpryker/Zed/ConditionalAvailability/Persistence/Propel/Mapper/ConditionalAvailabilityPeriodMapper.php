<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriod;
use Propel\Runtime\Collection\ObjectCollection;

class ConditionalAvailabilityPeriodMapper implements ConditionalAvailabilityPeriodMapperInterface
{
    /**
     * @inheritDoc
     */
    public function mapTransferToEntity(
        ConditionalAvailabilityPeriodTransfer $conditionalAvailabilityPeriodTransfer,
        FosConditionalAvailabilityPeriod $fosConditionalAvailabilityPeriod
    ): FosConditionalAvailabilityPeriod {
        $fosConditionalAvailabilityPeriod->fromArray(
            $conditionalAvailabilityPeriodTransfer->modifiedToArray(false),
        );

        return $fosConditionalAvailabilityPeriod;
    }

    /**
     * @inheritDoc
     */
    public function mapEntityToTransfer(
        FosConditionalAvailabilityPeriod $fosConditionalAvailabilityPeriod,
        ConditionalAvailabilityPeriodTransfer $conditionalAvailabilityPeriodTransfer
    ): ConditionalAvailabilityPeriodTransfer {
        return $conditionalAvailabilityPeriodTransfer->fromArray(
            $fosConditionalAvailabilityPeriod->toArray(),
            true,
        );
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $fosConditionalAvailabilityPeriods
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer $conditionalAvailabilityPeriodCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer
     */
    public function mapEntityCollectionToTransferCollection(
        ObjectCollection $fosConditionalAvailabilityPeriods,
        ConditionalAvailabilityPeriodCollectionTransfer $conditionalAvailabilityPeriodCollectionTransfer
    ): ConditionalAvailabilityPeriodCollectionTransfer {
        foreach ($fosConditionalAvailabilityPeriods as $fosConditionalAvailabilityPeriod) {
            $conditionalAvailabilityPeriodTransfer = $this->mapEntityToTransfer(
                $fosConditionalAvailabilityPeriod,
                new ConditionalAvailabilityPeriodTransfer(),
            );

            $conditionalAvailabilityPeriodCollectionTransfer->addConditionalAvailabilityPeriod(
                $conditionalAvailabilityPeriodTransfer,
            );
        }

        return $conditionalAvailabilityPeriodCollectionTransfer;
    }
}
