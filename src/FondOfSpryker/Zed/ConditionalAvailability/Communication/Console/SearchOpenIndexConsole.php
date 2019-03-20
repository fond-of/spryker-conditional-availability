<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use \Spryker\Zed\Search\Communication\Console\SearchOpenIndexConsole as SprykerSearchOpenIndexConsole;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 */
class SearchOpenIndexConsole extends SprykerSearchOpenIndexConsole
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName('conditional_availability:' . static::COMMAND_NAME);
    }
}
