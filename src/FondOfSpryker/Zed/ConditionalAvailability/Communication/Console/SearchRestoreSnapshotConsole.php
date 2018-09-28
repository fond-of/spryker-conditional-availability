<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\SearchFacadeInterface getFacade()
 */
class SearchRestoreSnapshotConsole extends \Spryker\Zed\Search\Communication\Console\SearchRestoreSnapshotConsole
{
    /**
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('conditional_availability:'.self::COMMAND_NAME);
    }
}
