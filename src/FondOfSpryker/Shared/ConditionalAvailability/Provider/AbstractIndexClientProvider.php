<?php

declare(strict_types=1);

namespace FondOfSpryker\Shared\ConditionalAvailability\Provider;

use Elastica\Index;
use Spryker\Shared\Config\Config;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Spryker\Shared\Search\Provider\AbstractIndexClientProvider as SprykerAbstractIndexClientProvider;

abstract class AbstractIndexClientProvider extends SprykerAbstractIndexClientProvider
{
    /**
     * @param string|null $index
     *
     * @throws \Exception
     *
     * @return \Elastica\Index
     */
    protected function createZedClient($index = null): Index
    {

        if ($index === null) {
            $index = Config::get(ConditionalAvailabilityConstants::ELASTICA_PARAMETER__INDEX_NAME);
        }

        return parent::createZedClient($index);
    }
}
