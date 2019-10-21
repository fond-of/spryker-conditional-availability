<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use Spryker\Zed\Search\Communication\Console\SearchCreateSnapshotConsole as SprykerSearchCreateSnapshotConsole;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\ConditionalAvailabilityFacadeInterface getFacade()
 */
class SearchCreateSnapshotConsole extends SprykerSearchCreateSnapshotConsole
{
    /**
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('conditional_availability:' . self::COMMAND_NAME);
    }
}
