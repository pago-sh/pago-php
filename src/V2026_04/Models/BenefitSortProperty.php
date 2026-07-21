<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * BenefitSortProperty
 */
enum BenefitSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case DESCRIPTION = 'description';
    case DESCRIPTION_2 = '-description';
    case TYPE = 'type';
    case TYPE_2 = '-type';
    case USER_ORDER = 'user_order';
    case USER_ORDER_2 = '-user_order';
}