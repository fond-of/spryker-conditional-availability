<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Search\SearchDependencyProvider;

class ConditionalAvailabilityDependencyProvider extends SearchDependencyProvider
{
    public const CLIENT = 'CLIENT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addConditionalAvailabilityClient($container);

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
}
