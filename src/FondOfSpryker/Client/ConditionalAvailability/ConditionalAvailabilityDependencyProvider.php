<?php

declare(strict_types=1);

namespace FondOfSpryker\Client\ConditionalAvailability;

use FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilityDateQueryExpander;
use FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilityMaxSizeQueryExpander;
use FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilityPingSearchQueryPlugin;
use FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilitySkuSearchQueryPlugin;
use FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilityWarehouseExpander;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ConditionalAvailabilityDependencyProvider extends AbstractDependencyProvider
{
    public const CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_PLUGIN = 'CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_PLUGIN';
    public const CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_EXPANDER_PLUGINS = 'CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_EXPANDER_PLUGINS';
    public const CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_FORMATTER_PLUGINS = 'CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_FORMATTER_PLUGINS';
    public const CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_PLUGIN = 'CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_PLUGIN';
    public const CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_EXPANDER_PLUGINS = 'CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_EXPANDER_PLUGINS';
    public const CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_FORMATTER_PLUGINS = 'CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_FORMATTER_PLUGINS';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addConditionalAvailabilitySkuSearchQueryPlugin($container);
        $container = $this->addConditionalAvailabilitySkuSearchQueryExpanderPlugins($container);
        $container = $this->addConditionalAvailabilitySkuSearchQueryFormatterPlugins($container);
        $container = $this->addConditionalAvailabilityPingSearchQueryPlugin($container);
        $container = $this->addConditionalAvailabilityPingSearchQueryExpanderPlugins($container);
        $container = $this->addConditionalAvailabilityPingSearchQueryFormatterPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addConditionalAvailabilitySkuSearchQueryPlugin(Container $container): Container
    {
        $container[static::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_PLUGIN] = function () {
            return new ConditionalAvailabilitySkuSearchQueryPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addConditionalAvailabilitySkuSearchQueryExpanderPlugins(Container $container): Container
    {
        $container[static::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_EXPANDER_PLUGINS] = function () {
            return $this->createConditionalAvailabilitySkuSearchQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createConditionalAvailabilitySkuSearchQueryExpanderPlugins(): array
    {
        return [
            new ConditionalAvailabilityWarehouseExpander(),
            new ConditionalAvailabilityDateQueryExpander(),
            new ConditionalAvailabilityMaxSizeQueryExpander(),
        ];
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addConditionalAvailabilitySkuSearchQueryFormatterPlugins(Container $container): Container
    {
        $container[static::CONDITIONAL_AVAILABILITY_SKU_SEARCH_QUERY_FORMATTER_PLUGINS] = function () {
            return $this->createConditionalAvailabilitySkuSearchQueryFormatterPlugins();
        };

        return $container;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createConditionalAvailabilitySkuSearchQueryFormatterPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addConditionalAvailabilityPingSearchQueryPlugin(Container $container): Container
    {
        $container[static::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_PLUGIN] = function () {
            return new ConditionalAvailabilityPingSearchQueryPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addConditionalAvailabilityPingSearchQueryExpanderPlugins(Container $container): Container
    {
        $container[static::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_EXPANDER_PLUGINS] = function () {
            return $this->createConditionalAvailabilityPingSearchQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createConditionalAvailabilityPingSearchQueryExpanderPlugins(): array
    {
        return [
            new ConditionalAvailabilityMaxSizeQueryExpander(),
        ];
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addConditionalAvailabilityPingSearchQueryFormatterPlugins(Container $container): Container
    {
        $container[static::CONDITIONAL_AVAILABILITY_PING_SEARCH_QUERY_FORMATTER_PLUGINS] = function () {
            return $this->createConditionalAvailabilityPingSearchQueryFormatterPlugins();
        };

        return $container;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createConditionalAvailabilityPingSearchQueryFormatterPlugins(): array
    {
        return [];
    }
}
