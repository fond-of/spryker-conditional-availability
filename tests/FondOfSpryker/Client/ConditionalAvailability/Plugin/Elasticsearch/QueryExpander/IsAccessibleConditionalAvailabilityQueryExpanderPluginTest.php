<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander;

use ArrayObject;
use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Term;
use Exception;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\CompanyUser\CompanyUserClientInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Model\Elasticsearch\Query\QueryBuilderInterface;

class IsAccessibleConditionalAvailabilityQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\QueryExpander\IsAccessibleConditionalAvailabilityQueryExpanderPlugin
     */
    protected $isAccessibleConditionalAvailabilityQueryExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityFactory
     */
    protected $conditionalAvailabilityFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected $queryInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    protected $queryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\BoolQuery
     */
    protected $boolQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Model\Elasticsearch\Query\QueryBuilderInterface
     */
    protected $queryBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\Term
     */
    protected $termMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyUser\CompanyUserClientInterface
     */
    protected $companyUserClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @var \ArrayObject
     */
    protected $companyUsers;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Company\Business\Model\CompanyInterface
     */
    protected $companyTransferMock;

    /**
     * @var array
     */
    protected $requestParametersCustomer;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var array
     */
    protected $requestParametersQuote;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParametersCustomer = [
            ConditionalAvailabilityConstants::PARAMETER_CUSTOMER_TRANSFER => $this->customerTransferMock,
        ];

        $this->requestParametersQuote = [
            ConditionalAvailabilityConstants::PARAMETER_QUOTE_TRANSFER => $this->quoteTransferMock,
        ];

        $this->queryInterfaceMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryBuilderInterfaceMock = $this->getMockBuilder(QueryBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->termMock = $this->getMockBuilder(Term::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityFactoryMock = $this->getMockBuilder(ConditionalAvailabilityFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->boolQueryMock = $this->getMockBuilder(BoolQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserClientInterfaceMock = $this->getMockBuilder(CompanyUserClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUsers = new ArrayObject([
            $this->companyUserTransferMock,
        ]);

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin = new IsAccessibleConditionalAvailabilityQueryExpanderPlugin();
        $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->setFactory($this->conditionalAvailabilityFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(1);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn("customer-reference");

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('getCompanyUserClient')
            ->willReturn($this->companyUserClientInterfaceMock);

        $this->companyUserClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($this->companyUsers);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeast(2))
            ->method('getDebtorNumber')
            ->willReturn("5debtor_number");

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('createQueryBuilder')
            ->willReturn($this->queryBuilderInterfaceMock);

        $this->queryBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createTermQuery')
            ->willReturn($this->termMock);

        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects($this->atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersCustomer));
    }

    /**
     * @depends testExpandQuery
     *
     * @return void
     */
    public function testExpandQueryIsAccessible(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(1);

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('createQueryBuilder')
            ->willReturn($this->queryBuilderInterfaceMock);

        $this->queryBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createTermQuery')
            ->willReturn($this->termMock);

        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects($this->atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersCustomer));
    }

    /**
     * @return void
     */
    public function testExpandQueryNoCustomerReference(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(2);

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersCustomer));
    }

    /**
     * @return void
     */
    public function testExpandQueryCompanyUsersLarge(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(3);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn("customer-reference");

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('getCompanyUserClient')
            ->willReturn($this->companyUserClientInterfaceMock);

        $this->companyUserClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn(new ArrayObject(["first", "second"]));

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersCustomer));
    }

    /**
     * @return void
     */
    public function testExpandQueryCantAddIsAccessible(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(4);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn("customer-reference");

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('getCompanyUserClient')
            ->willReturn($this->companyUserClientInterfaceMock);

        $this->companyUserClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($this->companyUsers);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersCustomer));
    }

    /**
     * @return void
     */
    public function testExpandQueryInvalidArgumentException(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(5);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn("customer-reference");

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('getCompanyUserClient')
            ->willReturn($this->companyUserClientInterfaceMock);

        $this->companyUserClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($this->companyUsers);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeast(2))
            ->method('getDebtorNumber')
            ->willReturn("5debtor_number");

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('createQueryBuilder')
            ->willReturn($this->queryBuilderInterfaceMock);

        $this->queryBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createTermQuery')
            ->willReturn($this->termMock);

        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        try {
            $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersCustomer));
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testExpandQueryQuote(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getIdQuote')
            ->willReturn(1);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeast(2))
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeast(2))
            ->method('getDebtorNumber')
            ->willReturn('5debtor-number');

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('createQueryBuilder')
            ->willReturn($this->queryBuilderInterfaceMock);

        $this->queryBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createTermQuery')
            ->willReturn($this->termMock);

        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects($this->atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersQuote));
    }

    /**
     * @depends testExpandQueryQuote
     *
     * @return void
     */
    public function testExpandQueryQuoteIsAccessible(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getIdQuote')
            ->willReturn(1);

        $this->conditionalAvailabilityFactoryMock->expects($this->atLeastOnce())
            ->method('createQueryBuilder')
            ->willReturn($this->queryBuilderInterfaceMock);

        $this->queryBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createTermQuery')
            ->willReturn($this->termMock);

        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects($this->atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersQuote));
    }

    /**
     * @return void
     */
    public function testExpandQueryQuoteCantAddIsAccessible(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getIdQuote')
            ->willReturn(2);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersQuote));
    }

    /**
     * @return void
     */
    public function testExpandQueryQuoteNoCompanyUserTransfer(): void
    {

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getIdQuote')
            ->willReturn(3);

        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock, $this->requestParametersQuote));
    }

    /**
     * @return void
     */
    public function testExpandQueryNoParams(): void
    {
        $this->assertInstanceOf(QueryInterface::class, $this->isAccessibleConditionalAvailabilityQueryExpanderPlugin->expandQuery($this->queryInterfaceMock));
    }
}
