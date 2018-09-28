<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Business\SearchFacadeInterface getFacade()
 */
class SearchDeleteIndexConsole extends \Spryker\Zed\Search\Communication\Console\SearchDeleteIndexConsole
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
