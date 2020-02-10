<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriod;
use Propel\Runtime\Collection\ObjectCollection;

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

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $fosConditionalAvailabilityPeriods
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer $conditionalAvailabilityPeriodCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer
     */
    public function mapEntityCollectionToTransferCollection(
        ObjectCollection $fosConditionalAvailabilityPeriods,
        ConditionalAvailabilityPeriodCollectionTransfer $conditionalAvailabilityPeriodCollectionTransfer
    ): ConditionalAvailabilityPeriodCollectionTransfer;
}
