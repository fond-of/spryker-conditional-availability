<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Provider;

use Elastica\Index;
use FondOfSpryker\Shared\ConditionalAvailability\Provider\AbstractIndexClientProvider;

class IndexClientProvider extends AbstractIndexClientProvider
{
    /**
     * @param string|null $index
     *
     * @throws
     *
     * @return \Elastica\Index
     */
    public function getClient(?string $index = null): Index
    {
        return $this->createZedClient($index);
    }
}
