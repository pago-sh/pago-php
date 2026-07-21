<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * Timeframe
 */
enum Timeframe: string
{
    case YEAR = 'year';
    case MONTH = 'month';
    case DAY = 'day';
}