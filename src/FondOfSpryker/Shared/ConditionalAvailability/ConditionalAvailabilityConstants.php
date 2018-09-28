<?php

namespace FondOfSpryker\Shared\ConditionalAvailability;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface ConditionalAvailabilityConstants
{
    /**
     * Elasticsearch connection index name. (Required)
     *
     * @api
     */
    const ELASTICA_PARAMETER__INDEX_NAME = 'CA_ELASTICA_PARAMETER__INDEX_NAME';

    /**
     * Elasticsearch connection document type. (Required)
     *
     * @api
     */
    const ELASTICA_PARAMETER__DOCUMENT_TYPE = 'CA_ELASTICA_PARAMETER__DOCUMENT_TYPE';

    /**
     * Specification:
     * - Defines a suffix string for the index name to be installed. (Optional)
     *
     * @api
     */
    const INDEX_NAME_SUFFIX = 'CA__INDEX_NAME_SUFFIX';

    /**
     * Specification:
     * - Sets the permission mode for generated directories.
     *
     * @api
     */
    const DIRECTORY_PERMISSION = 'CA:DIRECTORY_PERMISSION';
}
