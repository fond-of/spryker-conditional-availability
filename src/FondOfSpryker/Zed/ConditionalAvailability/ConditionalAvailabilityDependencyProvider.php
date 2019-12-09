<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Search\SearchDependencyProvider;

class ConditionalAvailabilityDependencyProvider extends SearchDependencyProvider
{
    public const CLIENT = 'CLIENT';

    public const PLUGINS_CONDITIONAL_AVAILABILITY_POST_SAVE = 'PLUGIN_CONDITIONAL_AVAILABILITY_POST_SAVE';
    public const PLUGINS_CONDITIONAL_AVAILABILITY_HYDRATION = 'PLUGINS_CONDITIONAL_AVAILABILITY_HYDRATION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addConditionalAvailabilityClient($container);
        $container = $this->addConditionalAvailabilityPostSavePlugins($container);
        $container = $this->addConditionalAvailabilityHydrationPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addConditionalAvailabilityClient(Container $container): Container
    {
        $container[static::CLIENT] = function (Container $container) {
            return $container->getLocator()->conditionalAvailability()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addConditionalAvailabilityPostSavePlugins(Container $container): Container
    {
        $container[static::PLUGINS_CONDITIONAL_AVAILABILITY_POST_SAVE] = function () {
            return $this->getConditionalAvailabilityPostSavePlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityPostSavePluginInterface[]
     */
    protected function getConditionalAvailabilityPostSavePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addConditionalAvailabilityHydrationPlugins(Container $container): Container
    {
        $container[static::PLUGINS_CONDITIONAL_AVAILABILITY_HYDRATION] = function () {
            return $this->getConditionalAvailabilityHydrationPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityHydrationPluginInterface[]
     */
    protected function getConditionalAvailabilityHydrationPlugins(): array
    {
        return [];
    }
}
