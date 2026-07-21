<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * OrderSortProperty
 */
enum OrderSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case STATUS = 'status';
    case STATUS_2 = '-status';
    case INVOICE_NUMBER = 'invoice_number';
    case INVOICE_NUMBER_2 = '-invoice_number';
    case AMOUNT = 'amount';
    case AMOUNT_2 = '-amount';
    case NET_AMOUNT = 'net_amount';
    case NET_AMOUNT_2 = '-net_amount';
    case CUSTOMER = 'customer';
    case CUSTOMER_2 = '-customer';
    case PRODUCT = 'product';
    case PRODUCT_2 = '-product';
    case DISCOUNT = 'discount';
    case DISCOUNT_2 = '-discount';
    case SUBSCRIPTION = 'subscription';
    case SUBSCRIPTION_2 = '-subscription';
}