<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomerOrderSortProperty
 */
enum CustomerOrderSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case AMOUNT = 'amount';
    case AMOUNT_2 = '-amount';
    case NET_AMOUNT = 'net_amount';
    case NET_AMOUNT_2 = '-net_amount';
    case PRODUCT = 'product';
    case PRODUCT_2 = '-product';
    case SUBSCRIPTION = 'subscription';
    case SUBSCRIPTION_2 = '-subscription';
}