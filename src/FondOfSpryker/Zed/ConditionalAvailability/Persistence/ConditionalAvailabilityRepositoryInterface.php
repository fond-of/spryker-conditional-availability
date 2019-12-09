<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence;

use Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer;
use Generated\Shared\Transfer\ConditionalAvailabilityTransfer;

interface ConditionalAvailabilityRepositoryInterface
{
    /**
     * @param int $idConditionalAvailability
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityTransfer|null
     */
    public function findConditionalAvailabilityById(
        int $idConditionalAvailability
    ): ?ConditionalAvailabilityTransfer;

    /**
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityCollectionTransfer
     */
    public function findAllConditionalAvailabilities(): ConditionalAvailabilityCollectionTransfer;

    /**
     * @param int $fkConditionalAvailability
     *
     * @throws
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodCollectionTransfer
     */
    public function findConditionalAvailabilityPeriodsByFkConditionalAvailability(
        int $fkConditionalAvailability
    ): ConditionalAvailabilityPeriodCollectionTransfer;
}
