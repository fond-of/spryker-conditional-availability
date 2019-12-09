<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailability;

class ConditionalAvailabilityMapper implements ConditionalAvailabilityMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     * @param \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailability $fosConditionalAvailability
     *
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailability
     */
    public function mapTransferToEntity(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer,
        FosConditionalAvailability $fosConditionalAvailability
    ): FosConditionalAvailability {
        $fosConditionalAvailability->fromArray(
            $conditionalAvailabilityTransfer->modifiedToArray(false)
        );

        return $fosConditionalAvailability;
    }

    /**
     * @param \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailability $fosConditionalAvailability
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer
     */
    public function mapEntityToTransfer(
        FosConditionalAvailability $fosConditionalAvailability,
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityTransfer {
        return $conditionalAvailabilityTransfer->fromArray(
            $fosConditionalAvailability->toArray(),
            true
        );
    }
}
