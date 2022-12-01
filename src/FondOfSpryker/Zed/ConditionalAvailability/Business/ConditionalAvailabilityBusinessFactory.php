<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business;

use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPeriodsPersister;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPeriodsPersisterInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutor;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityPluginExecutorInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityReader;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityReaderInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityWriter;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityWriterInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\GroupedConditionalAvailabilityReader;
use FondOfSpryker\Zed\ConditionalAvailability\Business\Model\GroupedConditionalAvailabilityReaderInterface;
use FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface getEntityManager()
 */
class ConditionalAvailabilityBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityReaderInterface
     */
    public function createConditionalAvailabilityReader(): ConditionalAvailabilityReaderInterface
    {
        return new ConditionalAvailabilityReader(
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\GroupedConditionalAvailabilityReaderInterface
     */
    public function createGroupedConditionalAvailabilityReader(): GroupedConditionalAvailabilityReaderInterface
    {
        return new GroupedConditionalAvailabilityReader(
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Business\Model\ConditionalAvailabilityWriterInterface
     */
    public function createConditionalAvailabilityWriter(): ConditionalAvailabilityWriterInterface
    {
        return new ConditionalAvailabilityWriter(
            $this->getEntityManager(),
            $this->createConditionalAvailabilityPluginExecutor(),
            $this->getLogger(),
        );
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
        );
    }

    /**
     * @return array<\FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityPostSavePluginInterface>
     */
    protected function getConditionalAvailabilityPostSavePlugins(): array
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_POST_SAVE,
        );
    }
}
