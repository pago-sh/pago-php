<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CheckoutSortProperty
 */
enum CheckoutSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case EXPIRES_AT = 'expires_at';
    case EXPIRES_AT_2 = '-expires_at';
    case STATUS = 'status';
    case STATUS_2 = '-status';
}