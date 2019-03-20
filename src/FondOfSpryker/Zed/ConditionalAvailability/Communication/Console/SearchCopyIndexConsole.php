<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use \Spryker\Zed\Search\Communication\Console\SearchCopyIndexConsole as SprykerSearchCopyIndexConsole;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 */
class SearchCopyIndexConsole extends SprykerSearchCopyIndexConsole
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
