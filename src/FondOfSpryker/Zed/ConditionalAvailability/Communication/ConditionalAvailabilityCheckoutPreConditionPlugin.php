<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Plugin;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreConditionInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 */
class ConditionalAvailabilityCheckoutPreConditionPlugin extends AbstractPlugin implements CheckoutPreConditionInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return bool
     */
    public function checkCondition(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer): bool
    {
        return $this->getFacade()->checkoutConditionalAvailabilityPreCondition($quoteTransfer, $checkoutResponseTransfer);
    }
}
