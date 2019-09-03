<?php

namespace FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator;

use Codeception\Test\Unit;
use DateTime;

class EarliestDeliveryDateGeneratorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\EarliestDeliveryDateGenerator\EarliestDeliveryDateGenerator
     */
    protected $earliestDeliveryDateGenerator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->earliestDeliveryDateGenerator = new EarliestDeliveryDateGenerator();
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->assertInstanceOf(DateTime::class, $this->earliestDeliveryDateGenerator->generate());
    }
}
