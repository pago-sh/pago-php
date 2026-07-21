<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomerWalletSortProperty
 */
enum CustomerWalletSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case BALANCE = 'balance';
    case BALANCE_2 = '-balance';
}