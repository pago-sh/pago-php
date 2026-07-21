<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomerSortProperty
 */
enum CustomerSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case EMAIL = 'email';
    case EMAIL_2 = '-email';
    case NAME = 'name';
    case NAME_2 = '-name';
}