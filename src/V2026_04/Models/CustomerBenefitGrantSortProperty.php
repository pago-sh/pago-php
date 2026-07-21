<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomerBenefitGrantSortProperty
 */
enum CustomerBenefitGrantSortProperty: string
{
    case GRANTED_AT = 'granted_at';
    case GRANTED_AT_2 = '-granted_at';
    case TYPE = 'type';
    case TYPE_2 = '-type';
    case ORGANIZATION = 'organization';
    case ORGANIZATION_2 = '-organization';
    case PRODUCT_BENEFIT = 'product_benefit';
    case PRODUCT_BENEFIT_2 = '-product_benefit';
}