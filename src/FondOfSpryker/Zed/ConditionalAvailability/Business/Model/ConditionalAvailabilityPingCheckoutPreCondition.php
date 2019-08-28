<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use DateTimeImmutable;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig;
use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Config\Environment;

class ConditionalAvailabilityPingCheckoutPreCondition implements ConditionalAvailabilityPingCheckoutPreConditionInterface
{
    protected const SEARCH_KEY = 'pings';

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
     * @throws
     *
     * @return bool
     */
    public function checkCondition(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponse): bool
    {
        if (Environment::getInstance()->isDevelopment()) {
            return true;
        }

        $dateTimeUntil = new DateTimeImmutable();
        $dateTimeFrom = $dateTimeUntil->modify('-1 hour');

        $result = $this->conditionalAvailabilityClient->conditionalAvailabilityLastPingSearch($dateTimeFrom, $dateTimeUntil);

        if (array_key_exists(static::SEARCH_KEY, $result) && count($result[static::SEARCH_KEY]) > 0) {
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
