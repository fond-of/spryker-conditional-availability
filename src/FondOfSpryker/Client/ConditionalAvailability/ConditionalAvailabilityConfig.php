<?php

declare(strict_types=1);

namespace FondOfSpryker\Client\ConditionalAvailability;

use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Spryker\Client\Search\SearchConfig;

class ConditionalAvailabilityConfig extends SearchConfig
{
    /**
     * @return string
     */
    public function getSearchIndexName(): string
    {
        return $this->get(ConditionalAvailabilityConstants::ELASTICA_PARAMETER__INDEX_NAME);
    }

    /**
     * @return string
     */
    public function getSearchDocumentType(): string
    {
        return $this->get(ConditionalAvailabilityConstants::ELASTICA_PARAMETER__DOCUMENT_TYPE);
    }
}
