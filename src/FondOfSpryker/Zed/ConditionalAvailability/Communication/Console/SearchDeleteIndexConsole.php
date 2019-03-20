<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use \Spryker\Zed\Search\Communication\Console\SearchDeleteIndexConsole as SprykerSearchDeleteIndexConsole;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 */
class SearchDeleteIndexConsole extends SprykerSearchDeleteIndexConsole
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
