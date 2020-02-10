<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Plugin\ConditionalAvailabilityExtension;

use FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityPostSavePluginInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 */
class ConditionalAvailabilityPeriodsPersisterPlugin extends AbstractPlugin implements ConditionalAvailabilityPostSavePluginInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function postSave(
        ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
    ): ConditionalAvailabilityResponseTransfer {
        if ($conditionalAvailabilityResponseTransfer->getIsSuccessful() === false
            || $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer() === null
        ) {
            return $conditionalAvailabilityResponseTransfer;
        }

        $conditionalAvailabilityTransfer = $this->getFacade()->persistConditionalAvailabilityPeriods(
            $conditionalAvailabilityResponseTransfer->getConditionalAvailabilityTransfer()
        );

        return $conditionalAvailabilityResponseTransfer->setConditionalAvailabilityTransfer(
            $conditionalAvailabilityTransfer
        );
    }
}
