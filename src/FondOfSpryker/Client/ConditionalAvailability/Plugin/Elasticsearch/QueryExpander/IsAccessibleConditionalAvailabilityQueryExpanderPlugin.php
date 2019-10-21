<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory getFactory()
 */
class IsAccessibleConditionalAvailabilityQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    protected static $isAccessibleFor = [
        'quoteIds' => [],
        'customerIds' => [],
    ];

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if (array_key_exists(ConditionalAvailabilityConstants::PARAMETER_CUSTOMER_TRANSFER, $requestParameters)) {
            return $this->expandQueryByCustomerTransfer(
                $searchQuery,
                $requestParameters[ConditionalAvailabilityConstants::PARAMETER_CUSTOMER_TRANSFER]
            );
        }

        if (array_key_exists(ConditionalAvailabilityConstants::PARAMETER_QUOTE_TRANSFER, $requestParameters)) {
            return $this->expandQueryByQuoteTransfer(
                $searchQuery,
                $requestParameters[ConditionalAvailabilityConstants::PARAMETER_QUOTE_TRANSFER]
            );
        }

        return $searchQuery;
    }

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function expandQueryByCustomerTransfer(
        QueryInterface $searchQuery,
        CustomerTransfer $customerTransfer
    ): QueryInterface {
        $idCustomer = $customerTransfer->getIdCustomer();

        if (in_array($idCustomer, static::$isAccessibleFor['customerIds'], true)) {
            $this->addIsAccessibleTermToQuery($searchQuery);
        }

        if ($customerTransfer->getCustomerReference() === null) {
            return $searchQuery;
        }

        $companyUserCollectionTransfer = $this->getFactory()->getCompanyUserClient()
            ->getActiveCompanyUsersByCustomerReference($customerTransfer);

        if ($companyUserCollectionTransfer->getCompanyUsers()->count() > 1) {
            return $searchQuery;
        }

        /** @var \Generated\Shared\Transfer\CompanyTransfer|null $companyTransfer */
        $companyTransfer = $companyUserCollectionTransfer->getCompanyUsers()
            ->offsetGet(0)
            ->getCompany();

        if (!$this->canAddIsAccessibleTermToQueryForCompanyTransfer($companyTransfer)) {
            return $searchQuery;
        }

        static::$isAccessibleFor['customerIds'][] = $idCustomer;

        return $this->addIsAccessibleTermToQuery($searchQuery);
    }

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function expandQueryByQuoteTransfer(
        QueryInterface $searchQuery,
        QuoteTransfer $quoteTransfer
    ): QueryInterface {
        $idQuote = $quoteTransfer->getIdQuote();

        if (in_array($idQuote, static::$isAccessibleFor['quoteIds'], true)) {
            $this->addIsAccessibleTermToQuery($searchQuery);
        }

        $companyUserTransfer = $quoteTransfer->getCompanyUser();

        if ($companyUserTransfer === null) {
            return $searchQuery;
        }

        $companyTransfer = $companyUserTransfer->getCompany();

        if ($companyTransfer === null && $companyUserTransfer->getCompanyBusinessUnit() !== null) {
            $companyTransfer = $companyUserTransfer->getCompanyBusinessUnit()->getCompany();
        }

        if (!$this->canAddIsAccessibleTermToQueryForCompanyTransfer($companyTransfer)) {
            return $searchQuery;
        }

        static::$isAccessibleFor['quoteIds'][] = $idQuote;

        return $this->addIsAccessibleTermToQuery($searchQuery);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer|null $companyTransfer
     *
     * @return bool
     */
    protected function canAddIsAccessibleTermToQueryForCompanyTransfer(?CompanyTransfer $companyTransfer): bool
    {
        return $companyTransfer !== null && $companyTransfer->getDebtorNumber() !== null
            && strpos($companyTransfer->getDebtorNumber(), '5') === 0;
    }

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function addIsAccessibleTermToQuery(QueryInterface $searchQuery): QueryInterface
    {
        $termQuery = $this->getFactory()->createQueryBuilder()->createTermQuery(
            PageIndexMap::ISACCESSIBLE,
            true
        );

        $this->getBoolQuery($searchQuery->getSearchQuery())
            ->addMust($termQuery);

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();
        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(sprintf(
                'Localized query expander available only with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery)
            ));
        }

        return $boolQuery;
    }
}
