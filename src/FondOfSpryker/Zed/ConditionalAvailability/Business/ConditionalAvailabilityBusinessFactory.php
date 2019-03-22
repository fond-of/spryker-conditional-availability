<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;

use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreCondition;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreConditionInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreCondition;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreConditionInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\Elasticsearch\Generator\IndexMapGenerator;
use Spryker\Zed\Search\Business\Model\Elasticsearch\Generator\IndexMapGeneratorInterface;
use Spryker\Zed\Search\Business\SearchBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface getClient()
 */
class ConditionalAvailabilityBusinessFactory extends SearchBusinessFactory
{
    /**
     * @return \FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider|\Spryker\Client\Search\Provider\IndexClientProvider
     */
    protected function createIndexProvider()
    {
        return new IndexClientProvider();
    }

    /**
     * @return \Spryker\Zed\Search\Business\Model\Elasticsearch\Generator\IndexMapGeneratorInterface
     */
    protected function createElasticsearchIndexMapGenerator(): IndexMapGeneratorInterface
    {
        return new IndexMapGenerator(
            $this->getConfig()->getClassTargetDirectory(),
            $this->getConfig()->getPermissionMode()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreConditionInterface
     */
    public function createConditionalAvailabilityPreCondition(): ConditionalAvailabilityCheckoutPreConditionInterface
    {
        return new ConditionalAvailabilityCheckoutPreCondition(
            $this->getConfig(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreConditionInterface
     */
    public function createConditionalAvailabilityPingPreCondition(): ConditionalAvailabilityPingCheckoutPreConditionInterface
    {
        return new ConditionalAvailabilityPingCheckoutPreCondition(
            $this->getConfig(),
            $this->getClient()
        );
    }
}
