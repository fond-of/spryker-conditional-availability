<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;

use ArrayObject;
use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface getRepository()
 */
class ConditionalAvailabilityFacade extends AbstractFacade implements ConditionalAvailabilityFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function findConditionalAvailabilityById(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityResponseTransfer {
        return $this->getFactory()->createConditionalAvailabilityReader()
            ->findById($conditionalAvailabilityTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function createConditionalAvailability(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityResponseTransfer {
        return $this->getFactory()->createConditionalAvailabilityWriter()
            ->create($conditionalAvailabilityTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function updateConditionalAvailability(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityResponseTransfer {
        return $this->getFactory()->createConditionalAvailabilityWriter()
            ->update($conditionalAvailabilityTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function deleteConditionalAvailability(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityResponseTransfer {
        return $this->getFactory()->createConditionalAvailabilityWriter()
            ->delete($conditionalAvailabilityTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer
     */
    public function persistConditionalAvailabilityPeriods(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityTransfer {
        return $this->getFactory()->createConditionalAvailabilityPeriodsPersister()
            ->persist($conditionalAvailabilityTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
     *
     * @return \ArrayObject<string,\Generated\Shared\Transfer\ConditionalAvailabilityTransfer[]>
     */
    public function findGroupedConditionalAvailabilities(
        ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
    ): ArrayObject {
        return $this->getFactory()->createGroupedConditionalAvailabilityReader()
            ->find($conditionalAvailabilityCriteriaFilterTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer
     */
    public function findConditionalAvailabilities(
        ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
    ): ConditionalAvailabilityCollectionTransfer {
        return $this->getFactory()->createConditionalAvailabilityReader()
            ->find($conditionalAvailabilityCriteriaFilterTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int[] $productConcreteIds
     *
     * @return int[]
     */
    public function getConditionalAvailabilityIdsByProductConcreteIds(array $productConcreteIds): array
    {
        return $this->getRepository()->getConditionalAvailabilityIdsByProductConcreteIds($productConcreteIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function persistConditionalAvailability(
        ConditionalAvailabilityTransfer $conditionalAvailabilityTransfer
    ): ConditionalAvailabilityResponseTransfer {
        return $this->getFactory()->createConditionalAvailabilityWriter()->persist($conditionalAvailabilityTransfer);
    }
}
