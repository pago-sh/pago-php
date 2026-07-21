<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * PaymentSortProperty
 */
enum PaymentSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case STATUS = 'status';
    case STATUS_2 = '-status';
    case AMOUNT = 'amount';
    case AMOUNT_2 = '-amount';
    case METHOD = 'method';
    case METHOD_2 = '-method';
}