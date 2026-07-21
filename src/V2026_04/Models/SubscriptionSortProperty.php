<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * SubscriptionSortProperty
 */
enum SubscriptionSortProperty: string
{
    case CUSTOMER = 'customer';
    case CUSTOMER_2 = '-customer';
    case STATUS = 'status';
    case STATUS_2 = '-status';
    case STARTED_AT = 'started_at';
    case STARTED_AT_2 = '-started_at';
    case CURRENT_PERIOD_END = 'current_period_end';
    case CURRENT_PERIOD_END_2 = '-current_period_end';
    case ENDED_AT = 'ended_at';
    case ENDED_AT_2 = '-ended_at';
    case ENDS_AT = 'ends_at';
    case ENDS_AT_2 = '-ends_at';
    case AMOUNT = 'amount';
    case AMOUNT_2 = '-amount';
    case PRODUCT = 'product';
    case PRODUCT_2 = '-product';
    case DISCOUNT = 'discount';
    case DISCOUNT_2 = '-discount';
}