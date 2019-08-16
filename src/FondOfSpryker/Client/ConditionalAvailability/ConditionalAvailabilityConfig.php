<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\ConditionalAvailability;

use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Generated\Shared\Transfer\PaginationConfigTransfer;
use Spryker\Client\Search\SearchConfig;

class ConditionalAvailabilityConfig extends SearchConfig
{
    protected const PAGINATION_DEFAULT_ITEMS_PER_PAGE = 12;
    protected const PAGINATION_VALID_ITEMS_PER_PAGE_OPTIONS = [12, 24, 36];
    protected const PAGINATION_PARAMETER_NAME_PAGE = 'page';
    protected const PAGINATION_ITEMS_PER_PAGE_PARAMETER_NAME = 'ipp';

    /**
     * @return \Generated\Shared\Transfer\PaginationConfigTransfer
     */
    public function getConditionalAvailabilityPaginationConfigTransfer(): PaginationConfigTransfer
    {
        return (new PaginationConfigTransfer())
            ->setParameterName(static::PAGINATION_PARAMETER_NAME_PAGE)
            ->setItemsPerPageParameterName(static::PAGINATION_ITEMS_PER_PAGE_PARAMETER_NAME)
            ->setDefaultItemsPerPage(static::PAGINATION_DEFAULT_ITEMS_PER_PAGE)
            ->setValidItemsPerPageOptions(static::PAGINATION_VALID_ITEMS_PER_PAGE_OPTIONS);
    }

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
