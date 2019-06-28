<?php

declare(strict_types = 1);

namespace FondOfSpryker\Shared\ConditionalAvailability;

interface ConditionalAvailabilityConstants
{
    public const ELASTICA_PARAMETER__INDEX_NAME = 'CA_ELASTICA_PARAMETER__INDEX_NAME';
    public const ELASTICA_PARAMETER__DOCUMENT_TYPE = 'CA_ELASTICA_PARAMETER__DOCUMENT_TYPE';
    public const INDEX_NAME_SUFFIX = 'CA__INDEX_NAME_SUFFIX';
    public const DIRECTORY_PERMISSION = 'CA:DIRECTORY_PERMISSION';

    public const PARAMETER_WAREHOUSE = 'warehouse';
    public const PARAMETER_SKU = 'sku';
    public const PARAMETER_START_AT = 'start_at';
    public const PARAMETER_END_AT = 'end_at';
    public const PARAMETER_SORT = 'sort';
}
