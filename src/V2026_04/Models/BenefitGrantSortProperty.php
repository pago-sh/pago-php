<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * BenefitGrantSortProperty
 */
enum BenefitGrantSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case GRANTED_AT = 'granted_at';
    case GRANTED_AT_2 = '-granted_at';
    case REVOKED_AT = 'revoked_at';
    case REVOKED_AT_2 = '-revoked_at';
}