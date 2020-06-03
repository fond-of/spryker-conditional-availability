<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailability;
use Propel\Runtime\Collection\ObjectCollection;

class ConditionalAvailabilityMapper implements ConditionalAvailabilityMapperInterface
{
    public const VIRTUAL_COLUMN_SKU = 'sku';

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper\ConditionalAvailabilityPeriodMapperInterface
     */
    protected $conditionalAvailabilityPeriodMapper;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper\ConditionalAvailabilityPeriodMapperInterface $conditionalAvailabilityPeriodMapper
     */
    public function __construct(ConditionalAvailabilityPeriodMapperInterface $conditionalAvailabilityPeriodMapper)
    {
        $this->conditionalAvailabilityPeriodMapper = $conditionalAvailabilityPeriodMapper;
    }

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
        $conditionalAvailabilityTransfer->fromArray(
            $fosConditionalAvailability->toArray(),
            true
        );

        $fosConditionalAvailabilityPeriods = $this->conditionalAvailabilityPeriodMapper
            ->mapEntityCollectionToTransferCollection(
                $fosConditionalAvailability->getFosConditionalAvailabilityPeriods(),
                new ConditionalAvailabilityPeriodCollectionTransfer()
            );

        $conditionalAvailabilityTransfer->setConditionalAvailabilityPeriodCollection(
            $fosConditionalAvailabilityPeriods
        );

        return $conditionalAvailabilityTransfer;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $fosConditionalAvailabilities
     * @param \ArrayObject $groupedConditionalAvailabilityTransfers
     *
     * @return \ArrayObject
     */
    public function mapEntityCollectionToGroupedTransfers(
        ObjectCollection $fosConditionalAvailabilities,
        ArrayObject $groupedConditionalAvailabilityTransfers
    ): ArrayObject {
        foreach ($fosConditionalAvailabilities as $fosConditionalAvailability) {
            $sku = $fosConditionalAvailability->getVirtualColumn(static::VIRTUAL_COLUMN_SKU);

            if (!$groupedConditionalAvailabilityTransfers->offsetExists($sku)) {
                $groupedConditionalAvailabilityTransfers->offsetSet($sku, new ArrayObject());
            }

            $conditionalAvailabilityTransfer = $this->mapEntityToTransfer(
                $fosConditionalAvailability,
                new ConditionalAvailabilityTransfer()
            );

            $groupedConditionalAvailabilityTransfers->offsetGet($sku)
                ->append($conditionalAvailabilityTransfer);
        }

        return $groupedConditionalAvailabilityTransfers;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $fosConditionalAvailabilities
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer $conditionalAvailabilityCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer
     */
    public function mapEntityCollectionToTransferCollection(
        ObjectCollection $fosConditionalAvailabilities,
        ConditionalAvailabilityCollectionTransfer $conditionalAvailabilityCollectionTransfer
    ): ConditionalAvailabilityCollectionTransfer {
        foreach ($fosConditionalAvailabilities as $fosConditionalAvailability) {
            $conditionalAvailabilityTransfer = $this->mapEntityToTransfer(
                $fosConditionalAvailability,
                new ConditionalAvailabilityTransfer()
            );

            $conditionalAvailabilityCollectionTransfer->addConditionalAvailability($conditionalAvailabilityTransfer);
        }

        return $conditionalAvailabilityCollectionTransfer;
    }
}
