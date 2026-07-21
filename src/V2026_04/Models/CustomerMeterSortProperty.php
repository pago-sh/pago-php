<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomerMeterSortProperty
 */
enum CustomerMeterSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case MODIFIED_AT = 'modified_at';
    case MODIFIED_AT_2 = '-modified_at';
    case CUSTOMER_ID = 'customer_id';
    case CUSTOMER_ID_2 = '-customer_id';
    case CUSTOMER_NAME = 'customer_name';
    case CUSTOMER_NAME_2 = '-customer_name';
    case METER_ID = 'meter_id';
    case METER_ID_2 = '-meter_id';
    case METER_NAME = 'meter_name';
    case METER_NAME_2 = '-meter_name';
    case CONSUMED_UNITS = 'consumed_units';
    case CONSUMED_UNITS_2 = '-consumed_units';
    case CREDITED_UNITS = 'credited_units';
    case CREDITED_UNITS_2 = '-credited_units';
    case BALANCE = 'balance';
    case BALANCE_2 = '-balance';
}