<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use \Spryker\Zed\Search\Communication\Console\GenerateIndexMapConsole as SprykerGenerateIndexMapConsole;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 */
class GenerateIndexMapConsole extends SprykerGenerateIndexMapConsole
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName('conditional_availability:' . self::COMMAND_NAME);
        $this->setAliases(['conditional_availability:setup:search:index-map']);
    }
}
