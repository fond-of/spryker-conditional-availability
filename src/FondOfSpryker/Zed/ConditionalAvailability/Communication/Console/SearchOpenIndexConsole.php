<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\SearchFacadeInterface getFacade()
 */
class SearchOpenIndexConsole extends \Spryker\Zed\Search\Communication\Console\SearchOpenIndexConsole
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();
        $this->setName('conditional_availability:'.static::COMMAND_NAME);
    }
}
