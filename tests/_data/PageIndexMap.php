<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Generated\Shared\ConditionalAvailability\Search;

use Spryker\Shared\Search\AbstractIndexMap;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF SEARCH MAP GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class PageIndexMap extends AbstractIndexMap
{
    const TYPE = 'type';
    const STORE = 'store';
    const CREATEDAT = 'createdAt';
    const STARTAT = 'startAt';
    const ENDAT = 'endAt';
    const QTY = 'qty';
    const SKU = 'sku';
    const WAREHOUSEGROUP = 'warehouseGroup';
    const LASTUPDATEAT = 'lastUpdateAt';
    const ISACCESSIBLE = 'isAccessible';

    /**
     * @var array
     */
    protected $metadata = [
        self::TYPE => [
            'type' => 'keyword',
            'include_in_all' => '',
        ],
        self::STORE => [
            'type' => 'keyword',
            'include_in_all' => '',
        ],
        self::CREATEDAT => [
            'type' => 'date',
            'format' => 'yyyy-MM-dd HH:mm:ss',
        ],
        self::STARTAT => [
            'type' => 'date',
            'format' => 'yyyy-MM-dd HH:mm:ss',
        ],
        self::ENDAT => [
            'type' => 'date',
            'format' => 'yyyy-MM-dd HH:mm:ss',
        ],
        self::QTY => [
            'type' => 'integer',
        ],
        self::SKU => [
            'type' => 'keyword',
        ],
        self::WAREHOUSEGROUP => [
            'type' => 'keyword',
        ],
        self::LASTUPDATEAT => [
            'type' => 'date',
            'format' => 'yyyy-MM-dd HH:mm:ss',
        ],
    ];
}
