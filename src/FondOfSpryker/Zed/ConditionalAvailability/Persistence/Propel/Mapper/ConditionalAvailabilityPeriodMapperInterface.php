<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriod;

interface ConditionalAvailabilityPeriodMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer $conditionalAvailabilityPeriodTransfer
     * @param \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriod $fosConditionalAvailabilityPeriod
     *
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriod
     */
    public function mapTransferToEntity(
        ConditionalAvailabilityPeriodTransfer $conditionalAvailabilityPeriodTransfer,
        FosConditionalAvailabilityPeriod $fosConditionalAvailabilityPeriod
    ): FosConditionalAvailabilityPeriod;

    /**
     * @param \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriod $fosConditionalAvailabilityPeriod
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer $conditionalAvailabilityPeriodTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer
     */
    public function mapEntityToTransfer(
        FosConditionalAvailabilityPeriod $fosConditionalAvailabilityPeriod,
        ConditionalAvailabilityPeriodTransfer $conditionalAvailabilityPeriodTransfer
    ): ConditionalAvailabilityPeriodTransfer;
}
