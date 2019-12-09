<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Persistence;

use FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper\ConditionalAvailabilityMapper;
use FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper\ConditionalAvailabilityMapperInterface;
use FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper\ConditionalAvailabilityPeriodMapper;
use FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper\ConditionalAvailabilityPeriodMapperInterface;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriodQuery;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\ConditionalAvailabilityConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailability\Persistence\ConditionalAvailabilityRepositoryInterface getRepository()
 */
class ConditionalAvailabilityPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery
     */
    public function createConditionalAvailabilityQuery(): FosConditionalAvailabilityQuery
    {
        return FosConditionalAvailabilityQuery::create();
    }

    /**
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriodQuery
     */
    public function createConditionalAvailabilityPeriodQuery(): FosConditionalAvailabilityPeriodQuery
    {
        return FosConditionalAvailabilityPeriodQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper\ConditionalAvailabilityMapperInterface
     */
    public function createConditionalAvailabilityMapper(): ConditionalAvailabilityMapperInterface
    {
        return new ConditionalAvailabilityMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailability\Persistence\Propel\Mapper\ConditionalAvailabilityPeriodMapperInterface
     */
    public function createConditionalAvailabilityPeriodMapper(): ConditionalAvailabilityPeriodMapperInterface
    {
        return new ConditionalAvailabilityPeriodMapper();
    }
}
