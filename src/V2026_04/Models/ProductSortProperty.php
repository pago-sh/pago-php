<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * ProductSortProperty
 */
enum ProductSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case NAME = 'name';
    case NAME_2 = '-name';
    case PRICE_AMOUNT_TYPE = 'price_amount_type';
    case PRICE_AMOUNT_TYPE_2 = '-price_amount_type';
    case PRICE_AMOUNT = 'price_amount';
    case PRICE_AMOUNT_2 = '-price_amount';
}