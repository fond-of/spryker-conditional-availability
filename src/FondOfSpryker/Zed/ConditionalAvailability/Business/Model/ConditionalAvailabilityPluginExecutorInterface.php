<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer;

interface ConditionalAvailabilityPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function executePostSavePlugins(
        ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
    ): ConditionalAvailabilityResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function executeHydrationPlugins(
        ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
    ): ConditionalAvailabilityResponseTransfer;
}
