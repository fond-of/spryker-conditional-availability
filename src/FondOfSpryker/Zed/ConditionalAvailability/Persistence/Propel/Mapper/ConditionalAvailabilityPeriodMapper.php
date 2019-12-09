<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriod;

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
            $conditionalAvailabilityPeriodTransfer->modifiedToArray(false)
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
            true
        );
    }
}
