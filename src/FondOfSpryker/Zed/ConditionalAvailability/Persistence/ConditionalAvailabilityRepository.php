<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityPersistenceFactory getFactory()
 */
class ConditionalAvailabilityRepository extends AbstractRepository implements ConditionalAvailabilityRepositoryInterface
{
    public const VIRTUAL_COLUMN_SKU = 'sku';

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
        return $this->findConditionalAvailabilities(new ConditionalAvailabilityCriteriaFilterTransfer());
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
            $conditionalAvailabilityCriteriaFilterTransfer
        );

        return $this->getFactory()
            ->createConditionalAvailabilityMapper()
            ->mapEntityCollectionToTransferCollection(
                $fosConditionalAvailabilityQuery->find(),
                new ConditionalAvailabilityCollectionTransfer()
            );
    }

    /**
     * @param \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery $fosConditionalAvailabilityQuery
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
     *
     * @throws
     *
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery
     */
    protected function applyFilters(
        FosConditionalAvailabilityQuery $fosConditionalAvailabilityQuery,
        ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
    ): FosConditionalAvailabilityQuery {
        if ($conditionalAvailabilityCriteriaFilterTransfer->getSkus() !== null) {
            $fosConditionalAvailabilityQuery->useSpyProductQuery()
                ->filterBySku_In($conditionalAvailabilityCriteriaFilterTransfer->getSkus())
                ->endUse();
        } else {
            $fosConditionalAvailabilityQuery->innerJoinWithSpyProduct();
        }

        if ($conditionalAvailabilityCriteriaFilterTransfer->getMinimumQuantity() !== null) {
            $fosConditionalAvailabilityQuery->useFosConditionalAvailabilityPeriodQuery()
                ->filterByQuantity(
                    $conditionalAvailabilityCriteriaFilterTransfer->getMinimumQuantity(),
                    Criteria::GREATER_EQUAL
                )
                ->endUse();
        } else {
            $fosConditionalAvailabilityQuery->innerJoinWithFosConditionalAvailabilityPeriod();
        }

        if ($conditionalAvailabilityCriteriaFilterTransfer->getIsAccessible() !== null) {
            $fosConditionalAvailabilityQuery->filterByIsAccessible(
                $conditionalAvailabilityCriteriaFilterTransfer->getIsAccessible()
            );
        }

        return $fosConditionalAvailabilityQuery;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
     *
     * @return \ArrayObject<string,\Generated\Shared\Transfer\ConditionalAvailabilityTransfer[]>
     */
    public function findGroupedConditionalAvailabilities(
        ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
    ): ArrayObject {
        $fosConditionalAvailabilityQuery = $this->getFactory()
            ->createConditionalAvailabilityQuery();

        $fosConditionalAvailabilityQuery = $this->applyFilters(
            $fosConditionalAvailabilityQuery,
            $conditionalAvailabilityCriteriaFilterTransfer
        );

        $fosConditionalAvailabilityQuery = $fosConditionalAvailabilityQuery->withColumn(
            SpyProductTableMap::COL_SKU,
            static::VIRTUAL_COLUMN_SKU
        );

        return $this->getFactory()
            ->createConditionalAvailabilityMapper()
            ->mapEntityCollectionToGroupedTransfers($fosConditionalAvailabilityQuery->find(), new ArrayObject());
    }
}
