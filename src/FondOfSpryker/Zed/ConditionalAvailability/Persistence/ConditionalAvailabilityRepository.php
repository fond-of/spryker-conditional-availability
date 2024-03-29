<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery;
use Orm\Zed\ConditionalAvailability\Persistence\Map\FosConditionalAvailabilityPeriodTableMap;
use Orm\Zed\ConditionalAvailability\Persistence\Map\FosConditionalAvailabilityTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityPersistenceFactory getFactory()
 */
class ConditionalAvailabilityRepository extends AbstractRepository implements ConditionalAvailabilityRepositoryInterface
{
    /**
     * @var string
     */
    public const VIRTUAL_COLUMN_SKU = 'sku';

    /**
     * @var string
     */
    protected const RELATION_ALIAS_FOS_CONDITIONAL_AVAILABILITY_PERIOD = 'FosConditionalAvailabilityPeriod';

    /**
     * @param int $idConditionalAvailability
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer|null
     */
    public function findConditionalAvailabilityById(int $idConditionalAvailability): ?ConditionalAvailabilityTransfer
    {
        $fosConditionalAvailability = $this->getFactory()
            ->createConditionalAvailabilityQuery()
            ->useFosConditionalAvailabilityPeriodQuery()
                ->addAscendingOrderByColumn(FosConditionalAvailabilityPeriodTableMap::COL_START_AT)
            ->endUse()
            ->with(static::RELATION_ALIAS_FOS_CONDITIONAL_AVAILABILITY_PERIOD)
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
     * @param int $fkConditionalAvailability
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer
     */
    public function findConditionalAvailabilityPeriodsByFkConditionalAvailability(
        int $fkConditionalAvailability
    ): ConditionalAvailabilityPeriodCollectionTransfer {
        $fosConditionalAvailabilityPeriods = $this->getFactory()
            ->createConditionalAvailabilityPeriodQuery()
            ->filterByFkConditionalAvailability($fkConditionalAvailability)
            ->addAscendingOrderByColumn(FosConditionalAvailabilityPeriodTableMap::COL_START_AT)
            ->find();

        $conditionalAvailabilityPeriodCollectionTransfer = new ConditionalAvailabilityPeriodCollectionTransfer();

        foreach ($fosConditionalAvailabilityPeriods as $fosConditionalAvailabilityPeriod) {
            $conditionalAvailabilityPeriodTransfer = $this->getFactory()
                ->createConditionalAvailabilityPeriodMapper()
                ->mapEntityToTransfer($fosConditionalAvailabilityPeriod, new ConditionalAvailabilityPeriodTransfer());

            $conditionalAvailabilityPeriodCollectionTransfer
                ->addConditionalAvailabilityPeriod($conditionalAvailabilityPeriodTransfer);
        }

        return $conditionalAvailabilityPeriodCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer
     */
    public function findConditionalAvailabilities(
        ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
    ): ConditionalAvailabilityCollectionTransfer {
        $fosConditionalAvailabilityQuery = $this->getFactory()
            ->createConditionalAvailabilityQuery();

        $fosConditionalAvailabilityQuery = $this->applyFilters(
            $fosConditionalAvailabilityQuery,
            $conditionalAvailabilityCriteriaFilterTransfer,
        );

        return $this->getFactory()
            ->createConditionalAvailabilityMapper()
            ->mapEntityCollectionToTransferCollection(
                $fosConditionalAvailabilityQuery->find(),
                new ConditionalAvailabilityCollectionTransfer(),
            );
    }

    /**
     * @param \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery $fosConditionalAvailabilityQuery
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
     *
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery
     */
    protected function applyFilters(
        FosConditionalAvailabilityQuery $fosConditionalAvailabilityQuery,
        ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
    ): FosConditionalAvailabilityQuery {
        $skus = $conditionalAvailabilityCriteriaFilterTransfer->getSkus();

        if (count($skus) !== 0) {
            $fosConditionalAvailabilityQuery->useSpyProductQuery()
                ->filterBySku_In($conditionalAvailabilityCriteriaFilterTransfer->getSkus())
                ->endUse();
        } else {
            $fosConditionalAvailabilityQuery->innerJoinWithSpyProduct();
        }

        if ($conditionalAvailabilityCriteriaFilterTransfer->getWarehouseGroup() !== null) {
            $fosConditionalAvailabilityQuery->filterByWarehouseGroup(
                $conditionalAvailabilityCriteriaFilterTransfer->getWarehouseGroup(),
            );
        }

        if ($conditionalAvailabilityCriteriaFilterTransfer->getMinimumQuantity() !== null) {
            $fosConditionalAvailabilityQuery->useFosConditionalAvailabilityPeriodQuery()
                ->filterByQuantity(
                    $conditionalAvailabilityCriteriaFilterTransfer->getMinimumQuantity(),
                    Criteria::GREATER_EQUAL,
                )->addAscendingOrderByColumn(FosConditionalAvailabilityPeriodTableMap::COL_START_AT)
                ->endUse();
        } else {
            $fosConditionalAvailabilityQuery->useFosConditionalAvailabilityPeriodQuery()
                ->addAscendingOrderByColumn(FosConditionalAvailabilityPeriodTableMap::COL_START_AT)
                ->endUse();
        }

        $fosConditionalAvailabilityQuery->with(static::RELATION_ALIAS_FOS_CONDITIONAL_AVAILABILITY_PERIOD);

        if ($conditionalAvailabilityCriteriaFilterTransfer->getIsAccessible() !== null) {
            $fosConditionalAvailabilityQuery->filterByIsAccessible(
                $conditionalAvailabilityCriteriaFilterTransfer->getIsAccessible(),
            );
        }

        return $fosConditionalAvailabilityQuery;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
     *
     * @return \ArrayObject<string, \ArrayObject<\Generated\Shared\Transfer\ConditionalAvailabilityTransfer>>
     */
    public function findGroupedConditionalAvailabilities(
        ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
    ): ArrayObject {
        $fosConditionalAvailabilityQuery = $this->getFactory()
            ->createConditionalAvailabilityQuery();

        $fosConditionalAvailabilityQuery = $this->applyFilters(
            $fosConditionalAvailabilityQuery,
            $conditionalAvailabilityCriteriaFilterTransfer,
        );

        $fosConditionalAvailabilityQuery = $fosConditionalAvailabilityQuery->withColumn(
            SpyProductTableMap::COL_SKU,
            static::VIRTUAL_COLUMN_SKU,
        );

        return $this->getFactory()
            ->createConditionalAvailabilityMapper()
            ->mapEntityCollectionToGroupedTransfers($fosConditionalAvailabilityQuery->find(), new ArrayObject());
    }

    /**
     * @param array<int> $productConcreteIds
     *
     * @return array<int>
     */
    public function getConditionalAvailabilityIdsByProductConcreteIds(array $productConcreteIds): array
    {
        $fosConditionalAvailabilityQuery = $this->getFactory()
            ->createConditionalAvailabilityQuery();

        $columnsToSelect = [FosConditionalAvailabilityTableMap::COL_ID_CONDITIONAL_AVAILABILITY];

        return $fosConditionalAvailabilityQuery->select($columnsToSelect)
            ->filterByFkProduct_In($productConcreteIds)
            ->distinct()
            ->find()
            ->toArray();
    }
}
