<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use ArrayObject;
use DateTime;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig;
use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ConditionalAvailabilityCheckoutPreCondition implements ConditionalAvailabilityCheckoutPreConditionInterface
{
    protected const CHECKOUT_PRODUCT_UNAVAILABLE_TRANSLATION_KEY = 'product.unavailable';

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
        $isPassed = true;

        $groupedItems = $this->groupItemsBySkuAndDeliveryDate($quoteTransfer->getItems());

        foreach ($groupedItems as $deliveryDate => $skus) {
            foreach ($skus as $sku => $quantity) {

                $isAvailable = $this->isProductAvailable(
                    $deliveryDate,
                    $sku,
                    $quantity,
                    $this->conditionalAvailabilityConfig->getDefaultWarehouse()
                );

                if ($isAvailable) {
                    continue;
                }

                $this->addAvailabilityErrorToCheckoutResponse($checkoutResponse, $sku);
                $isPassed = false;
            }
        }

        return $isPassed;
    }

    /**
     * @param string $deliveryDate
     * @param string $sku
     * @param int $quantity
     * @param string $warehouse
     *
     * @return bool
     */
    protected function isProductAvailable(
        string $deliveryDate,
        string $sku,
        int $quantity,
        string $warehouse
    ): bool {
        $requestParameters = [
            ConditionalAvailabilityConstants::PARAMETER_WAREHOUSE => $warehouse,
            ConditionalAvailabilityConstants::PARAMETER_START_AT => new DateTime($deliveryDate),
            ConditionalAvailabilityConstants::PARAMETER_END_AT => new DateTime($deliveryDate),
        ];

        $result = $this->conditionalAvailabilityClient->conditionalAvailabilitySkuSearch($sku, $requestParameters);

        foreach ($result->getResults() as $resultSet) {
            $data = $resultSet->getData();
            $dataQuantityInt = (int) $data['qty'];

            if ($dataQuantityInt >= $quantity) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $items
     *
     * @return array
     */
    protected function groupItemsBySkuAndDeliveryDate(ArrayObject $items): array
    {
        $result = [];

        foreach ($items as $itemTransfer) {
            $sku = $itemTransfer->getSku();
            $deliveryDate = $itemTransfer->getConcreteDeliveryDate();

            if (!isset($result[$deliveryDate])) {
                $result[$deliveryDate] = [];
            }

            if (!isset($result[$deliveryDate][$sku])) {
                $result[$deliveryDate][$sku] = 0;
            }

            $result[$deliveryDate][$sku] += $itemTransfer->getQuantity();
        }

        return $result;
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
     * @param string $sku
     *
     * @return void
     */
    protected function addAvailabilityErrorToCheckoutResponse(CheckoutResponseTransfer $checkoutResponse, string $sku): void
    {
        $checkoutErrorTransfer = $this->createCheckoutErrorTransfer();

        $checkoutErrorTransfer
            ->setErrorCode($this->conditionalAvailabilityConfig->getProductUnavailableErrorCode())
            ->setMessage(static::CHECKOUT_PRODUCT_UNAVAILABLE_TRANSLATION_KEY)
            ->setErrorType(
                $this->conditionalAvailabilityConfig->getAvailabilityErrorType()
            )
            ->setParameters([
                $this->conditionalAvailabilityConfig->getAvailabilityProductSkuParameter() => $sku,
            ]);

        $checkoutResponse
            ->addError($checkoutErrorTransfer)
            ->setIsSuccess(false);
    }
}
