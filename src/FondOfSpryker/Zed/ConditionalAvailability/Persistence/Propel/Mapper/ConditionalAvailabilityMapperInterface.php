<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailability;
use Propel\Runtime\Collection\ObjectCollection;

interface ConditionalAvailabilityMapperInterface
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
    ): FosConditionalAvailability;

    /**
     * @param \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailability $fosConditionalAvailability
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer
     */
    public function mapEntityToTransfer(
        FosConditionalAvailability $fosConditionalAvailability,
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $fosConditionalAvailabilities
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer $conditionalAvailabilityCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer
     */
    public function mapEntityCollectionToTransferCollection(
        ObjectCollection $fosConditionalAvailabilities,
        ConditionalAvailabilityCollectionTransfer $conditionalAvailabilityCollectionTransfer
    ): ConditionalAvailabilityCollectionTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $fosConditionalAvailabilities
     * @param \ArrayObject<string,\Generated\Shared\Transfer\ConditionalAvailabilityTransfer[]> $groupedConditionalAvailabilityTransfers
     *
     * @return \ArrayObject<string,\Generated\Shared\Transfer\ConditionalAvailabilityTransfer[]>
     */
    public function mapEntityCollectionToGroupedTransfers(
        ObjectCollection $fosConditionalAvailabilities,
        ArrayObject $groupedConditionalAvailabilities
    ): ArrayObject;
}
