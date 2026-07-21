<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * DiscountSortProperty
 */
enum DiscountSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case NAME = 'name';
    case NAME_2 = '-name';
    case CODE = 'code';
    case CODE_2 = '-code';
    case REDEMPTIONS_COUNT = 'redemptions_count';
    case REDEMPTIONS_COUNT_2 = '-redemptions_count';
    case ENDS_AT = 'ends_at';
    case ENDS_AT_2 = '-ends_at';
}