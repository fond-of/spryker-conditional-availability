<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class ConditionalAvailabilityDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_CONDITIONAL_AVAILABILITY_POST_SAVE = 'PLUGIN_CONDITIONAL_AVAILABILITY_POST_SAVE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addConditionalAvailabilityPostSavePlugins($container);

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
     * @return array<\FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityPostSavePluginInterface>
     */
    protected function getConditionalAvailabilityPostSavePlugins(): array
    {
        return [];
    }
}
