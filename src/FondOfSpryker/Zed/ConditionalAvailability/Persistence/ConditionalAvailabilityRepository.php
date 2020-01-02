<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence;

use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\Map\FosConditionalAvailabilityTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityPersistenceFactory getFactory()
 */
class ConditionalAvailabilityRepository extends AbstractRepository implements ConditionalAvailabilityRepositoryInterface
{
    public const VIRTUAL_COLUMN_SKU = 'sku';
    public const VIRTUAL_COLUMN_WAREHOUSE_GROUP = 'warehouse_group';
    public const VIRTUAL_COLUMN_IS_ACCESSIBLE = 'is_accessible';

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

    /**
     * @param string $warehouseGroup
     * @param bool $isAccessible
     *
     * @throws
     *
     * @return array
     */
    public function findConditionalAvailabilityDataByWarehouseGroupAndIsAccessible(
        string $warehouseGroup,
        bool $isAccessible
    ): array {
        $fosConditionalAvailabilityQuery = $this->getFactory()
            ->createConditionalAvailabilityQuery();

        $fosConditionalAvailabilityQuery
            ->innerJoinSpyProduct()
            ->innerJoinFosConditionalAvailabilityPeriod()
            ->filterByWarehouseGroup($warehouseGroup)
            ->filterByIsAccessible($isAccessible)
            ->withColumn(
                SpyProductTableMap::COL_SKU,
                static::VIRTUAL_COLUMN_SKU
            )
            ->withColumn(
                FosConditionalAvailabilityTableMap::COL_WAREHOUSE_GROUP,
                static::VIRTUAL_COLUMN_WAREHOUSE_GROUP
            )
            ->withColumn(
                FosConditionalAvailabilityTableMap::COL_IS_ACCESSIBLE,
                static::VIRTUAL_COLUMN_IS_ACCESSIBLE
            );
    }
}
