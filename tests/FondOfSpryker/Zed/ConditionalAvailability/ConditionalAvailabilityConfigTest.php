<?php

namespace FondOfSpryker\Zed\ConditionalAvailability;

use Codeception\Test\Unit;

class ConditionalAvailabilityConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig
     */
    protected $conditionalAvailabilityConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->conditionalAvailabilityConfig = new ConditionalAvailabilityConfig();
    }

    /**
     * @return void
     */
    public function testGetProductUnavailableErrorCode(): void
    {
        $this->assertSame(ConditionalAvailabilityConfig::ERROR_CODE_PRODUCT_UNAVAILABLE, $this->conditionalAvailabilityConfig->getProductUnavailableErrorCode());
    }

    /**
     * @return void
     */
    public function testGetAvailabilityErrorType(): void
    {
        $this->assertSame("Availability", $this->conditionalAvailabilityConfig->getAvailabilityErrorType());
    }

    /**
     * @return void
     */
    public function testGetAvailabilityProductSkuParameter(): void
    {
        $this->assertSame('%sku%', $this->conditionalAvailabilityConfig->getAvailabilityProductSkuParameter());
    }

    /**
     * @return void
     */
    public function testGetAvailabilityPingFailedErrorCode(): void
    {
        $this->assertSame(ConditionalAvailabilityConfig::ERROR_CODE_AVAILABILITY_PING_FAILED, $this->conditionalAvailabilityConfig->getAvailabilityPingFailedErrorCode());
    }

    /**
     * @return void
     */
    public function testGetAvailabilityPingFailedErrorType(): void
    {
        $this->assertSame('Availability Ping', $this->conditionalAvailabilityConfig->getAvailabilityPingFailedErrorType());
    }

    /**
     * @return void
     */
    public function testGetDefaultWarehouse(): void
    {
        $this->assertSame('EU', $this->conditionalAvailabilityConfig->getDefaultWarehouse());
    }

    /**
     * @return void
     */
    public function testGetClassTargetDirectory(): void
    {
        $this->assertNotFalse(strpos($this->conditionalAvailabilityConfig->getClassTargetDirectory(), '/Generated/Shared/ConditionalAvailability/Search/'));
    }

    /**
     * @return void
     */
    public function testGetJsonIndexDefinitionDirectories(): void
    {
        $this->assertIsArray($this->conditionalAvailabilityConfig->getJsonIndexDefinitionDirectories());
    }
}
