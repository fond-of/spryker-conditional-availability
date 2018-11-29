<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Dependency\Plugin;

interface WarehouseStringSetterInterface
{
    /**
     * @api
     *
     * @param string $warehouse
     *
     * @return void
     */
    public function setWarehouseString(string $warehouse);
}
