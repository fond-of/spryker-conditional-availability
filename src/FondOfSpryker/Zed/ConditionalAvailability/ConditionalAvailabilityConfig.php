<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability;

use Spryker\Zed\Search\SearchConfig;

class ConditionalAvailabilityConfig extends SearchConfig
{
    protected const WAREHOUSE_DEFAULT = 'EU';

    public const ERROR_CODE_PRODUCT_UNAVAILABLE = 4102;
    public const ERROR_CODE_AVAILABILITY_PING_FAILED = 4102;

    protected const ERROR_TYPE_AVAILABILITY = 'Availability';
    protected const ERROR_TYPE_AVAILABILITY_PING = 'Availability Ping';

    protected const PARAMETER_PRODUCT_SKU_AVAILABILITY = '%sku%';

    /**
     * @return int
     */
    public function getProductUnavailableErrorCode(): int
    {
        return static::ERROR_CODE_PRODUCT_UNAVAILABLE;
    }

    /**
     * @return string
     */
    public function getAvailabilityErrorType(): string
    {
        return static::ERROR_TYPE_AVAILABILITY;
    }

    /**
     * @return string
     */
    public function getAvailabilityProductSkuParameter(): string
    {
        return static::PARAMETER_PRODUCT_SKU_AVAILABILITY;
    }

    /**
     * @return int
     */
    public function getAvailabilityPingFailedErrorCode(): int
    {
        return static::ERROR_CODE_AVAILABILITY_PING_FAILED;
    }

    /**
     * @return string
     */
    public function getAvailabilityPingFailedErrorType(): string
    {
        return static::ERROR_TYPE_AVAILABILITY_PING;
    }

    /**
     * @return string
     */
    public function getDefaultWarehouse(): string
    {
        return static::WAREHOUSE_DEFAULT;
    }

    /**
     * @return string
     */
    public function getClassTargetDirectory(): string
    {
        return APPLICATION_SOURCE_DIR . '/Generated/Shared/ConditionalAvailability/Search/';
    }

    /**
     * @return string[]
     */
    public function getJsonIndexDefinitionDirectories(): array
    {
        $directories = [];

        $fondOfSprykerSharedGlobPattern = APPLICATION_ROOT_DIR . '/vendor/fond-of-spryker/*/src/*/Shared/*/ConditionalAvailabilityMap/';
        if (\glob($fondOfSprykerSharedGlobPattern)) {
            $directories[] = $fondOfSprykerSharedGlobPattern;
        }

        return $directories;
    }
}
