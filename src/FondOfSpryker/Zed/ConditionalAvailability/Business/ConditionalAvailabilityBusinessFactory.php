<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;

use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreCondition;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityCheckoutPreConditionInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityHydrator;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityHydratorInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPeriodsPersister;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPeriodsPersisterInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreCondition;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreConditionInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutor;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutorInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityReader;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityReaderInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityWriter;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityWriterInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\Elasticsearch\Generator\IndexMapGenerator;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityDependencyProvider;
use Spryker\Zed\Search\Business\Model\Elasticsearch\Generator\IndexMapGeneratorInterface;
use Spryker\Zed\Search\Business\SearchBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface getEntityManager()
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
            $this->getConditionalAvailabilityClient()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPingCheckoutPreConditionInterface
     */
    public function createConditionalAvailabilityPingPreCondition(): ConditionalAvailabilityPingCheckoutPreConditionInterface
    {
        return new ConditionalAvailabilityPingCheckoutPreCondition(
            $this->getConfig(),
            $this->getConditionalAvailabilityClient()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface
     */
    protected function getConditionalAvailabilityClient(): ConditionalAvailabilityClientInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityDependencyProvider::CLIENT);
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityReaderInterface
     */
    public function createConditionalAvailabilityReader(): ConditionalAvailabilityReaderInterface
    {
        return new ConditionalAvailabilityReader(
            $this->getRepository(),
            $this->createConditionalAvailabilityPluginExecutor()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityWriterInterface
     */
    public function createConditionalAvailabilityWriter(): ConditionalAvailabilityWriterInterface
    {
        return new ConditionalAvailabilityWriter(
            $this->getEntityManager(),
            $this->createConditionalAvailabilityPluginExecutor()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityHydratorInterface
     */
    public function createConditionalAvailabilityHydrator(): ConditionalAvailabilityHydratorInterface
    {
        return new ConditionalAvailabilityHydrator($this->getRepository());
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPeriodsPersisterInterface
     */
    public function createConditionalAvailabilityPeriodsPersister(): ConditionalAvailabilityPeriodsPersisterInterface
    {
        return new ConditionalAvailabilityPeriodsPersister($this->getEntityManager());
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutorInterface
     */
    protected function createConditionalAvailabilityPluginExecutor(): ConditionalAvailabilityPluginExecutorInterface
    {
        return new ConditionalAvailabilityPluginExecutor(
            $this->getConditionalAvailabilityPostSavePlugins(),
            $this->getConditionalAvailabilityHydrationPlugins()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityPostSavePluginInterface[]
     */
    protected function getConditionalAvailabilityPostSavePlugins(): array
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_POST_SAVE
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityHydrationPluginInterface[]
     */
    protected function getConditionalAvailabilityHydrationPlugins(): array
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_HYDRATION
        );
    }
}
