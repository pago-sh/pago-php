<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * RefundSortProperty
 */
enum RefundSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case AMOUNT = 'amount';
    case AMOUNT_2 = '-amount';
}