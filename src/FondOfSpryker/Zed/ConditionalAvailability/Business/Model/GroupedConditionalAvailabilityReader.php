<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use ArrayObject;
use FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer;

class GroupedConditionalAvailabilityReader implements GroupedConditionalAvailabilityReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface $repository
     */
    public function __construct(ConditionalAvailabilityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
     *
     * @return \ArrayObject<string, \ArrayObject<\Generated\Shared\Transfer\ConditionalAvailabilityTransfer>>
     */
    public function find(
        ConditionalAvailabilityCriteriaFilterTransfer $conditionalAvailabilityCriteriaFilterTransfer
    ): ArrayObject {
        return $this->repository->findGroupedConditionalAvailabilities($conditionalAvailabilityCriteriaFilterTransfer);
    }
}
