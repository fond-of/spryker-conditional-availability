<?php

namespace FondOfSpryker\Shared\ConditionalAvailability\Provider;

use Spryker\Shared\Config\Config;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;

abstract class AbstractIndexClientProvider extends \Spryker\Shared\Search\Provider\AbstractIndexClientProvider
{
    /**
     * @param string|null $index
     *
     * @return \Elastica\Index
     */
    protected function createZedClient($index = null)
    {
        $index = ($index !== null) ? $index : Config::get(ConditionalAvailabilityConstants::ELASTICA_PARAMETER__INDEX_NAME);
        return parent::createZedClient($index);
    }
}
