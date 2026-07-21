<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomerSubscriptionSortProperty
 */
enum CustomerSubscriptionSortProperty: string
{
    case STARTED_AT = 'started_at';
    case STARTED_AT_2 = '-started_at';
    case AMOUNT = 'amount';
    case AMOUNT_2 = '-amount';
    case STATUS = 'status';
    case STATUS_2 = '-status';
    case ORGANIZATION = 'organization';
    case ORGANIZATION_2 = '-organization';
    case PRODUCT = 'product';
    case PRODUCT_2 = '-product';
}