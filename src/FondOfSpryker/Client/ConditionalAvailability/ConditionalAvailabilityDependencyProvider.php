<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\Query\ConditionalAvailabilitySearchQueryPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ConditionalAvailabilityDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';
    public const CONDITIONAL_AVAILABILITY_SEARCH_QUERY_PLUGIN = 'CONDITIONAL_AVAILABILITY_SEARCH_QUERY_PLUGIN';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container)
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addConditionalAvailabilitySearchQueryPlugin($container);

        return $container;
    }


    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addConditionalAvailabilitySearchQueryPlugin(Container $container): Container
    {
        $container[static::CONDITIONAL_AVAILABILITY_SEARCH_QUERY_PLUGIN] = function () {
            return new ConditionalAvailabilitySearchQueryPlugin();
        };

        return $container;
    }
}
