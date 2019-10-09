<?php

namespace FondOfSpryker\Client\ConditionalAvailability;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider;

class IndexClientProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Provider\IndexClientProvider
     */
    protected $indexClientProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->indexClientProvider = new IndexClientProvider();
    }
}
