<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use \Spryker\Zed\Search\Communication\Console\SearchCloseIndexConsole as SprykerSearchCloseIndexConsole;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 */
class SearchCloseIndexConsole extends SprykerSearchCloseIndexConsole
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName('conditional_availability:' . self::COMMAND_NAME);
    }
}
