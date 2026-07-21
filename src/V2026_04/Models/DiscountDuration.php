<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * DiscountDuration
 */
enum DiscountDuration: string
{
    case ONCE = 'once';
    case FOREVER = 'forever';
    case REPEATING = 'repeating';
}