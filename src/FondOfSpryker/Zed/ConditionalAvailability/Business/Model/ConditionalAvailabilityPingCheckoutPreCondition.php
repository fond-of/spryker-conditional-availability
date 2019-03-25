<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig;
use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Config\Environment;

class ConditionalAvailabilityPingCheckoutPreCondition implements ConditionalAvailabilityPingCheckoutPreConditionInterface
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface
     */
    protected $conditionalAvailabilityClient;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $conditionalAvailabilityConfig;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig $conditionalAvailabilityConfig
     * @param \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface $conditionalAvailabilityClient
     */
    public function __construct(
        ConditionalAvailabilityConfig $conditionalAvailabilityConfig,
        ConditionalAvailabilityClientInterface $conditionalAvailabilityClient
    ) {
        $this->conditionalAvailabilityConfig = $conditionalAvailabilityConfig;
        $this->conditionalAvailabilityClient = $conditionalAvailabilityClient;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponse
     *
     * @return bool
     */
    public function checkCondition(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponse): bool
    {
        $dateTimeUntil = new \DateTimeImmutable();
        if (Environment::getInstance()->isDevelopment()) {
            $dateTimeUntil = new \DateTimeImmutable('2019-02-27 11:23:36');
        }

        $dateTimeFrom = $dateTimeUntil->modify('-1 hour');

        $result = $this->conditionalAvailabilityClient->ConditionalAvailabilityLastPingSearch($dateTimeFrom, $dateTimeUntil);

        $isPassed = $result->getTotalHits() > 0;

        if ($isPassed) {
            return true;
        }

        $this->addAvailabilityErrorToCheckoutResponse($checkoutResponse);

        return false;
    }

    /**
     * @return \Generated\Shared\Transfer\CheckoutErrorTransfer
     */
    protected function createCheckoutErrorTransfer(): CheckoutErrorTransfer
    {
        return new CheckoutErrorTransfer();
    }

    /**
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponse
     *
     * @return void
     */
    protected function addAvailabilityErrorToCheckoutResponse(CheckoutResponseTransfer $checkoutResponse): void
    {
        $checkoutErrorTransfer = $this->createCheckoutErrorTransfer();

        $checkoutErrorTransfer
            ->setErrorCode($this->conditionalAvailabilityConfig->getAvailabilityPingFailedErrorCode())
            ->setMessage('availability ping failed')
            ->setErrorType($this->conditionalAvailabilityConfig->getAvailabilityPingFailedErrorType());

        $checkoutResponse
            ->addError($checkoutErrorTransfer)
            ->setIsSuccess(false);
    }
}
