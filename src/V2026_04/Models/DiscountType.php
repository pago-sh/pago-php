<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * DiscountType
 */
enum DiscountType: string
{
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
}