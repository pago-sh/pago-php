<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * RecurringInterval
 */
enum RecurringInterval: string
{
    case DAY = 'day';
    case WEEK = 'week';
    case MONTH = 'month';
    case YEAR = 'year';
}